<?php

class User
{
    public static function register($name, $email, $password) {
        
        $db = Db::getConnection();
        $collection = $db->users;
        $user = array(
            'name' => $name,
            'email' => $email,
            'password' => $password
        );
        return $collection->insertOne($user);
        
    }
    
    /**
     * Проверяет имя: не меньше, чем 2 символа
     */
    public static function checkName($name) {
        if (strlen($name)>=2) {
            return true;
        }
        return false;
    }
    
    /**
     * Проверяет password: не меньше, чем 6 символов
     */
    public static function checkPassword($password) {
        if (strlen($password) >= 6) {
            return true;
        }
        return false;
    }
    public static function checkPasswordConfirm($password,$password_confirm){
        if($password===$password_confirm) return true;
        return false;
    }
    /**
     * Проверяет email
     */
    public static function checkEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }
    public static function checkPhone($phone)
    {
        if ((strlen($phone) >= 10)&((ctype_digit($phone)==true))) {
            return true;
        }
        return false;
    }
    public static function checkEmailExists($email) {
        
        $db = Db::getConnection();
        $collection = $db->users;
        $filter=array(
            'email' => $email
        );
        if($collection->findOne($filter)){
            return true;
        }
        return false;
    }
    
    public static function checkUserData($email,$password)
    {
        $db=Db::getConnection();
        $collection = $db->users;
        $user = array(
            'email' => $email,
            'password' => $password
        );
        $cursor=$collection->findOne($user);
        if($collection) return $cursor{'_id'};
        return false;
    }

    public static function findAllUser()
    {
        // находим все в коллекции
        $db=Db::getConnection();
        $collection = $db->users;
        $cursor = $collection->find();
        return $cursor;
    }
    public static function auth($userId)
    {
        $_SESSION['user']=$userId;
    }

    public static function checkLogged()
    {
        //если есть сессия вернем id
        if(isset($_SESSION['user'])) return $_SESSION['user'];
        header("Location: /user/login/");
    }
    public static function isGuest()
    {
        if(isset($_SESSION['user'])) return false;
        return true;
    }
    public static function getUserById($id)
    {

        if ($id) {                        
            $db = Db::getConnection();
            $collection = $db->users;
            $user = array(
                '_id' => $id
            );
            $cursor=$collection->findOne($user);
            return $cursor;
        }
    }
    public static function edit($id, $name, $password)//
    {       
            $db = Db::getConnection();
            $sql="UPDATE users SET name= :name, password= :password WHERE id_user= :id_user";
            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);
            $result->bindParam(':name', $name, PDO::PARAM_STR);
            $result->bindParam(':password', $password, PDO::PARAM_STR);
            //получаем массив
            $result->setFetchMode(PDO::FETCH_ASSOC);
            return $result->execute();

            
    }
    
}