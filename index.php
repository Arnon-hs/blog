<?php

// FRONT CONTROLLER

// 1. Общие настройки
ini_set('display_errors',1);
error_reporting(E_ALL);


// 2. Подключение файлов системы
define('ROOT', dirname(__FILE__));
// require_once(ROOT.'/components/Stat.php');
require_once(ROOT.'/components/Autoload.php');
require_once(ROOT.'/vendor/autoload.php');

// 3. Включение сессии
session_start();
// 4.Сбор статистики
if(!isset($_COOKIE['userId'])){
    $userId = rand(1000, 9999) . '-' . time();
    setcookie('userId', $userId, time()+31536000, '/');
}
// echo '<p style="text-align:right">'. $_COOKIE['userId'] . ' ' . $_SERVER['REQUEST_URI'] . '</p>';
// var_dump($_SERVER);
ini_set('display_errors', 'Off');

if($_SERVER['REQUEST_URI']!='/favicon.ico'){
    $db = Db::getConnection();
    $collection = $db->stat;
    $user = array(
        'userId' => $_COOKIE['userId'],
        'requestUrl' => $_SERVER['REQUEST_URI'],
        'refererUrl' => $_SERVER['HTTP_REFERER']!==null?$_SERVER['HTTP_REFERER']:'direct transition',
        'language' => $_SERVER['HTTP_ACCEPT_LANGUAGE'],
        'ip' => $_SERVER['REMOTE_ADDR'],
        'userAgent' => $_SERVER['HTTP_USER_AGENT']
    );
    $collection->insertOne($user);
}

ini_set('display_errors',1);
// 5. Вызов Router
$router = new Router();
$router->run();
