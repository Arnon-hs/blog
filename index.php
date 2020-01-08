<?php

// FRONT CONTROLLER

// 1. Общие настройки
ini_set('display_errors',1);
error_reporting(E_ALL);


// 2. Подключение файлов системы
define('ROOT', dirname(__FILE__));
require_once(ROOT.'/components/Autoload.php');
require_once(ROOT.'/vendor/autoload.php');
// 3. Включение сессии
session_start();

// 4. Вызов Router
$router = new Router();
$router->run();
