<?php

class Db
{
    
    public static function getConnection()
    {
        // $paramsPath = ROOT . '/config/db_params.php';
        // $params = include($paramsPath);
        

        // $dsn = "mysql:host={$params['host']};port={$params['port']};dbname={$params['dbname']}";
        // $db = new PDO($dsn, $params['user'], $params['password'],[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        // $db->exec("set names utf8");
        
        
        
        // try {
        //     $mongo = new MongoDB\Client('mongodb://localhost:27017');
        //     $dbname = $connection->selectDB('db_blog');
        // } catch (Exception $e) {
        //     echo $e->getMessage();
        // }
        try{
            // соединяемся
            $m =  new MongoDB\Client('mongodb://localhost:27017');
            // выбираем базу данных
            $db = $m->db_blog;
            // выбираем коллекцию (аналог таблицы реляционной базы данных)
            return $db;
        }
        catch (Exception $e) {
            echo $e->getMessage();
            return true;
        }
    }

}
