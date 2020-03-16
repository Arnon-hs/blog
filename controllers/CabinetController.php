<?php
Class CabinetController
{
    public function actionIndex()
    {
        // id из сессии
        $userId= User::checkLogged();
        // Информация о пользователе из БД
        $user= User::getUserById($userId);
        require_once(ROOT. '/views/cabinet/index.php');
        return true;
    }
    public function actionEdit()
    {
        //Получаем id из сессии 
        $userId= User::checkLogged();
        //Получаем инфу о пользователе из бд
        $user=User::getUserById($userId);
        $firstname = $user['name'];
        $password = $user['password'];

        $result=false;

        if(isset($_POST['submit'])){
            $firstname=$_POST['name'];
            $password=$_POST['password'];

            $errors=false;

            if (!User::checkName($firstname,$secondname,$lastname)) {
                $errors[] = 'Имя не должно быть короче 2-х символов';
            }
            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }
            $hashPass=crypt($password,'$2a$07$usesomesillystringforsalt$');
            if($errors==false){
                $result=User::edit($userId,$firstname,$secondname,$lastname,$hashPass);
            }
        }
        require_once(ROOT. '/views/cabinet/edit.php');
        return true;
    }
}