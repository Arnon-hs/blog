--TEST--
Symbol: Multi-character
--DESCRIPTION--
Generated by scripts/convert-bson-corpus-tests.php

DO NOT EDIT THIS FILE
--FILE--
<?php

require_once __DIR__ . '/../utils/tools.php';

$canonicalBson = hex2bin('190000000E61000D0000006162616261626162616261620000');
$convertedBson = hex2bin('190000000261000D0000006162616261626162616261620000');
$canonicalExtJson = '{"a": {"$symbol": "abababababab"}}';
$convertedExtJson = '{"a": "abababababab"}';

// Canonical BSON -> Native -> Canonical BSON 
echo bin2hex(fromPHP(toPHP($canonicalBson))), "\n";

// Canonical BSON -> Canonical extJSON 
echo json_canonicalize(toCanonicalExtendedJSON($canonicalBson)), "\n";

// Canonical extJSON -> Canonical BSON 
echo bin2hex(fromJSON($canonicalExtJson)), "\n";

?>
===DONE===
<?php exit(0); ?>
--EXPECT--
190000000e61000d0000006162616261626162616261620000
{"a":{"$symbol":"abababababab"}}
190000000e61000d0000006162616261626162616261620000
===DONE===