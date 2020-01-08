/*
 * Copyright 2014-2017 MongoDB, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

#include <php.h>
#include <Zend/zend_interfaces.h>
#include <ext/standard/php_var.h>
#if PHP_VERSION_ID >= 70000
#include <zend_smart_str.h>
#else
#include <ext/standard/php_smart_str.h>
#endif

#ifdef HAVE_CONFIG_H
#include "config.h"
#endif

#include "phongo_compat.h"
#include "php_phongo.h"

zend_class_entry* php_phongo_objectid_ce;

/* Initialize the object with a generated value and return whether it was
 * successful. */
static bool php_phongo_objectid_init(php_phongo_objectid_t* intern)
{
	bson_oid_t oid;

	intern->initialized = true;

	bson_oid_init(&oid, NULL);
	bson_oid_to_string(&oid, intern->oid);

	return true;
}

/* Initialize the object from a hex string and return whether it was successful.
 * An exception will be thrown on error. */
static bool php_phongo_objectid_init_from_hex_string(php_phongo_objectid_t* intern, const char* hex, phongo_zpp_char_len hex_len TSRMLS_DC) /* {{{ */
{
	if (bson_oid_is_valid(hex, hex_len)) {
		bson_oid_t oid;

		bson_oid_init_from_string(&oid, hex);
		bson_oid_to_string(&oid, intern->oid);
		intern->initialized = true;

		return true;
	}

	phongo_throw_exception(PHONGO_ERROR_INVALID_ARGUMENT TSRMLS_CC, "Error parsing ObjectId string: %s", hex);

	return false;
} /* }}} */

/* Initialize the object from a HashTable and return whether it was successful.
 * An exception will be thrown on error. */
static bool php_phongo_objectid_init_from_hash(php_phongo_objectid_t* intern, HashTable* props TSRMLS_DC) /* {{{ */
{
#if PHP_VERSION_ID >= 70000
	zval* z_oid;

	z_oid = zend_hash_str_find(props, "oid", sizeof("oid") - 1);

	if (z_oid && Z_TYPE_P(z_oid) == IS_STRING) {
		return php_phongo_objectid_init_from_hex_string(intern, Z_STRVAL_P(z_oid), Z_STRLEN_P(z_oid) TSRMLS_CC);
	}
#else
	zval** z_oid;

	if (zend_hash_find(props, "oid", sizeof("oid"), (void**) &z_oid) == SUCCESS && Z_TYPE_PP(z_oid) == IS_STRING) {
		return php_phongo_objectid_init_from_hex_string(intern, Z_STRVAL_PP(z_oid), Z_STRLEN_PP(z_oid) TSRMLS_CC);
	}
#endif

	phongo_throw_exception(PHONGO_ERROR_INVALID_ARGUMENT TSRMLS_CC, "%s initialization requires \"oid\" string field", ZSTR_VAL(php_phongo_objectid_ce->name));
	return false;
} /* }}} */

/* {{{ proto void MongoDB\BSON\ObjectId::__construct([string $id])
   Constructs a new BSON ObjectId type, optionally from a hex string. */
static PHP_METHOD(ObjectId, __construct)
{
	php_phongo_objectid_t* intern;
	zend_error_handling    error_handling;
	char*                  id = NULL;
	phongo_zpp_char_len    id_len;

	zend_replace_error_handling(EH_THROW, phongo_exception_from_phongo_domain(PHONGO_ERROR_INVALID_ARGUMENT), &error_handling TSRMLS_CC);
	intern = Z_OBJECTID_OBJ_P(getThis());

	if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "|s!", &id, &id_len) == FAILURE) {
		zend_restore_error_handling(&error_handling TSRMLS_CC);
		return;
	}
	zend_restore_error_handling(&error_handling TSRMLS_CC);

	if (id) {
		php_phongo_objectid_init_from_hex_string(intern, id, id_len TSRMLS_CC);
	} else {
		php_phongo_objectid_init(intern);
	}
} /* }}} */

/* {{{ proto integer MongoDB\BSON\ObjectId::getTimestamp()
*/
static PHP_METHOD(ObjectId, getTimestamp)
{
	php_phongo_objectid_t* intern;
	bson_oid_t             tmp_oid;

	intern = Z_OBJECTID_OBJ_P(getThis());

	if (zend_parse_parameters_none() == FAILURE) {
		return;
	}

	bson_oid_init_from_string(&tmp_oid, intern->oid);
	RETVAL_LONG(bson_oid_get_time_t(&tmp_oid));
} /* }}} */

/* {{{ proto MongoDB\BSON\ObjectId::__set_state(array $properties)
*/
static PHP_METHOD(ObjectId, __set_state)
{
	php_phongo_objectid_t* intern;
	HashTable*             props;
	zval*                  array;

	if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "a", &array) == FAILURE) {
		RETURN_FALSE;
	}

	object_init_ex(return_value, php_phongo_objectid_ce);

	intern = Z_OBJECTID_OBJ_P(return_value);
	props  = Z_ARRVAL_P(array);

	php_phongo_objectid_init_from_hash(intern, props TSRMLS_CC);
} /* }}} */

/* {{{ proto string MongoDB\BSON\ObjectId::__toString()
*/
static PHP_METHOD(ObjectId, __toString)
{
	php_phongo_objectid_t* intern;

	intern = Z_OBJECTID_OBJ_P(getThis());

	if (zend_parse_parameters_none() == FAILURE) {
		return;
	}

	PHONGO_RETURN_STRINGL(intern->oid, 24);
} /* }}} */

/* {{{ proto array MongoDB\BSON\ObjectId::jsonSerialize()
*/
static PHP_METHOD(ObjectId, jsonSerialize)
{
	php_phongo_objectid_t* intern;

	if (zend_parse_parameters_none() == FAILURE) {
		return;
	}

	intern = Z_OBJECTID_OBJ_P(getThis());

	array_init_size(return_value, 1);
	ADD_ASSOC_STRINGL(return_value, "$oid", intern->oid, 24);
} /* }}} */

/* {{{ proto string MongoDB\BSON\ObjectId::serialize()
*/
static PHP_METHOD(ObjectId, serialize)
{
	php_phongo_objectid_t* intern;
	ZVAL_RETVAL_TYPE       retval;
	php_serialize_data_t   var_hash;
	smart_str              buf = { 0 };

	intern = Z_OBJECTID_OBJ_P(getThis());

	if (zend_parse_parameters_none() == FAILURE) {
		return;
	}

#if PHP_VERSION_ID >= 70000
	array_init_size(&retval, 2);
	ADD_ASSOC_STRINGL(&retval, "oid", intern->oid, 24);
#else
	ALLOC_INIT_ZVAL(retval);
	array_init_size(retval, 2);
	ADD_ASSOC_STRINGL(retval, "oid", intern->oid, 24);
#endif

	PHP_VAR_SERIALIZE_INIT(var_hash);
	php_var_serialize(&buf, &retval, &var_hash TSRMLS_CC);
	smart_str_0(&buf);
	PHP_VAR_SERIALIZE_DESTROY(var_hash);

	PHONGO_RETVAL_SMART_STR(buf);

	smart_str_free(&buf);
	zval_ptr_dtor(&retval);
} /* }}} */

/* {{{ proto void MongoDB\BSON\ObjectId::unserialize(string $serialized)
*/
static PHP_METHOD(ObjectId, unserialize)
{
	php_phongo_objectid_t* intern;
	zend_error_handling    error_handling;
	char*                  serialized;
	phongo_zpp_char_len    serialized_len;
#if PHP_VERSION_ID >= 70000
	zval props;
#else
	zval* props;
#endif
	php_unserialize_data_t var_hash;

	intern = Z_OBJECTID_OBJ_P(getThis());

	zend_replace_error_handling(EH_THROW, phongo_exception_from_phongo_domain(PHONGO_ERROR_INVALID_ARGUMENT), &error_handling TSRMLS_CC);

	if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "s", &serialized, &serialized_len) == FAILURE) {
		zend_restore_error_handling(&error_handling TSRMLS_CC);
		return;
	}
	zend_restore_error_handling(&error_handling TSRMLS_CC);

#if PHP_VERSION_ID < 70000
	ALLOC_INIT_ZVAL(props);
#endif
	PHP_VAR_UNSERIALIZE_INIT(var_hash);
	if (!php_var_unserialize(&props, (const unsigned char**) &serialized, (unsigned char*) serialized + serialized_len, &var_hash TSRMLS_CC)) {
		zval_ptr_dtor(&props);
		phongo_throw_exception(PHONGO_ERROR_UNEXPECTED_VALUE TSRMLS_CC, "%s unserialization failed", ZSTR_VAL(php_phongo_objectid_ce->name));

		PHP_VAR_UNSERIALIZE_DESTROY(var_hash);
		return;
	}
	PHP_VAR_UNSERIALIZE_DESTROY(var_hash);

#if PHP_VERSION_ID >= 70000
	php_phongo_objectid_init_from_hash(intern, HASH_OF(&props) TSRMLS_CC);
#else
	php_phongo_objectid_init_from_hash(intern, HASH_OF(props) TSRMLS_CC);
#endif
	zval_ptr_dtor(&props);
} /* }}} */

/* {{{ MongoDB\BSON\ObjectId function entries */
ZEND_BEGIN_ARG_INFO_EX(ai_ObjectId___construct, 0, 0, 0)
	ZEND_ARG_INFO(0, id)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(ai_ObjectId___set_state, 0, 0, 1)
	ZEND_ARG_ARRAY_INFO(0, properties, 0)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(ai_ObjectId_unserialize, 0, 0, 1)
	ZEND_ARG_INFO(0, serialized)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(ai_ObjectId_void, 0, 0, 0)
ZEND_END_ARG_INFO()

static zend_function_entry php_phongo_objectid_me[] = {
	/* clang-format off */
	PHP_ME(ObjectId, __construct, ai_ObjectId___construct, ZEND_ACC_PUBLIC | ZEND_ACC_FINAL)
	PHP_ME(ObjectId, getTimestamp, ai_ObjectId_void, ZEND_ACC_PUBLIC | ZEND_ACC_FINAL)
	PHP_ME(ObjectId, __set_state, ai_ObjectId___set_state, ZEND_ACC_PUBLIC | ZEND_ACC_STATIC)
	PHP_ME(ObjectId, __toString, ai_ObjectId_void, ZEND_ACC_PUBLIC | ZEND_ACC_FINAL)
	PHP_ME(ObjectId, jsonSerialize, ai_ObjectId_void, ZEND_ACC_PUBLIC | ZEND_ACC_FINAL)
	PHP_ME(ObjectId, serialize, ai_ObjectId_void, ZEND_ACC_PUBLIC | ZEND_ACC_FINAL)
	PHP_ME(ObjectId, unserialize, ai_ObjectId_unserialize, ZEND_ACC_PUBLIC | ZEND_ACC_FINAL)
	PHP_FE_END
	/* clang-format on */
};
/* }}} */

/* {{{ MongoDB\BSON\ObjectId object handlers */
static zend_object_handlers php_phongo_handler_objectid;

static void php_phongo_objectid_free_object(phongo_free_object_arg* object TSRMLS_DC) /* {{{ */
{
	php_phongo_objectid_t* intern = Z_OBJ_OBJECTID(object);

	zend_object_std_dtor(&intern->std TSRMLS_CC);

	if (intern->properties) {
		zend_hash_destroy(intern->properties);
		FREE_HASHTABLE(intern->properties);
	}

#if PHP_VERSION_ID < 70000
	efree(intern);
#endif
} /* }}} */

static phongo_create_object_retval php_phongo_objectid_create_object(zend_class_entry* class_type TSRMLS_DC) /* {{{ */
{
	php_phongo_objectid_t* intern = NULL;

	intern = PHONGO_ALLOC_OBJECT_T(php_phongo_objectid_t, class_type);

	zend_object_std_init(&intern->std, class_type TSRMLS_CC);
	object_properties_init(&intern->std, class_type);

#if PHP_VERSION_ID >= 70000
	intern->std.handlers = &php_phongo_handler_objectid;

	return &intern->std;
#else
	{
		zend_object_value retval;
		retval.handle   = zend_objects_store_put(intern, (zend_objects_store_dtor_t) zend_objects_destroy_object, php_phongo_objectid_free_object, NULL TSRMLS_CC);
		retval.handlers = &php_phongo_handler_objectid;

		return retval;
	}
#endif
} /* }}} */

static int php_phongo_objectid_compare_objects(zval* o1, zval* o2 TSRMLS_DC) /* {{{ */
{
	php_phongo_objectid_t* intern1;
	php_phongo_objectid_t* intern2;

	intern1 = Z_OBJECTID_OBJ_P(o1);
	intern2 = Z_OBJECTID_OBJ_P(o2);

	return strcmp(intern1->oid, intern2->oid);
} /* }}} */

static HashTable* php_phongo_objectid_get_gc(zval* object, phongo_get_gc_table table, int* n TSRMLS_DC) /* {{{ */
{
	*table = NULL;
	*n     = 0;

	return Z_OBJECTID_OBJ_P(object)->properties;
} /* }}} */

static HashTable* php_phongo_objectid_get_properties_hash(zval* object, bool is_debug TSRMLS_DC) /* {{{ */
{
	php_phongo_objectid_t* intern;
	HashTable*             props;

	intern = Z_OBJECTID_OBJ_P(object);

	PHONGO_GET_PROPERTY_HASH_INIT_PROPS(is_debug, intern, props, 1);

	if (!intern->initialized) {
		return props;
	}

#if PHP_VERSION_ID >= 70000
	{
		zval zv;

		ZVAL_STRING(&zv, intern->oid);
		zend_hash_str_update(props, "oid", sizeof("oid") - 1, &zv);
	}
#else
	{
		zval* zv;

		MAKE_STD_ZVAL(zv);
		ZVAL_STRING(zv, intern->oid, 1);
		zend_hash_update(props, "oid", sizeof("oid"), &zv, sizeof(zv), NULL);
	}
#endif

	return props;
} /* }}} */

static HashTable* php_phongo_objectid_get_debug_info(zval* object, int* is_temp TSRMLS_DC) /* {{{ */
{
	*is_temp = 1;
	return php_phongo_objectid_get_properties_hash(object, true TSRMLS_CC);
} /* }}} */

static HashTable* php_phongo_objectid_get_properties(zval* object TSRMLS_DC) /* {{{ */
{
	return php_phongo_objectid_get_properties_hash(object, false TSRMLS_CC);
} /* }}} */
/* }}} */

void php_phongo_objectid_init_ce(INIT_FUNC_ARGS) /* {{{ */
{
	zend_class_entry ce;

	INIT_NS_CLASS_ENTRY(ce, "MongoDB\\BSON", "ObjectId", php_phongo_objectid_me);
	php_phongo_objectid_ce                = zend_register_internal_class(&ce TSRMLS_CC);
	php_phongo_objectid_ce->create_object = php_phongo_objectid_create_object;
	PHONGO_CE_FINAL(php_phongo_objectid_ce);

	zend_class_implements(php_phongo_objectid_ce TSRMLS_CC, 1, php_phongo_objectid_interface_ce);
	zend_class_implements(php_phongo_objectid_ce TSRMLS_CC, 1, php_phongo_json_serializable_ce);
	zend_class_implements(php_phongo_objectid_ce TSRMLS_CC, 1, php_phongo_type_ce);
	zend_class_implements(php_phongo_objectid_ce TSRMLS_CC, 1, zend_ce_serializable);

	memcpy(&php_phongo_handler_objectid, phongo_get_std_object_handlers(), sizeof(zend_object_handlers));
	php_phongo_handler_objectid.compare_objects = php_phongo_objectid_compare_objects;
	php_phongo_handler_objectid.get_debug_info  = php_phongo_objectid_get_debug_info;
	php_phongo_handler_objectid.get_gc          = php_phongo_objectid_get_gc;
	php_phongo_handler_objectid.get_properties  = php_phongo_objectid_get_properties;
#if PHP_VERSION_ID >= 70000
	php_phongo_handler_objectid.free_obj = php_phongo_objectid_free_object;
	php_phongo_handler_objectid.offset   = XtOffsetOf(php_phongo_objectid_t, std);
#endif
} /* }}} */

/*
 * Local variables:
 * tab-width: 4
 * c-basic-offset: 4
 * End:
 * vim600: noet sw=4 ts=4 fdm=marker
 * vim<600: noet sw=4 ts=4
 */
