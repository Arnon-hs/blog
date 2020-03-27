<?php

class Db
{
    
    public static function getConnection()
    {
        try{
            // соединяемся
            $m =  new MongoDB\Client('mongodb://localhost:27017');
            // выбираем базу данных
            $db = $m->db_blog;
            return $db;
        }
        catch (Exception $e) {
            echo $e->getMessage();
            return true;
        }
    }

}
