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
        $name = $user['name'];
        $password = "";

        $result=false;

        if(isset($_POST['submit'])){
            $name = $_POST['name'];
            !empty($_POST['password'])? $password = $_POST['password']: $password = null;

            $errors=false;

            if (!User::checkName($name)) {
                $errors[] = 'Имя не должно быть короче 2-х символов';
            }
            if (!User::checkPassword($password) && $password != null) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }
            $hashPass=crypt($password,'$2a$07$usesomesillystringforsalt$');
            if($errors==false){
                $result=User::edit($userId,$name,$hashPass);
            }
        }
        require_once(ROOT. '/views/cabinet/edit.php');
        return true;
    }
    public function actionHistory()
    {
        $userId= User::checkLogged();
        $blogItems = Blog::getBlogItemsByUserId($userId);
        require_once(ROOT. '/views/cabinet/history.php');
        return true;
    }
    public function actionStat()
    {
        $title = 'Статистика сайта';
        $description = 'Анализируем посещаемость сайта';
        require_once(ROOT. '/views/cabinet/stat.php');
        return true;
    }
    public function actionRedact($id)
    {//редактирование поста
        
        if($id){
            $post = Blog::getBlogItemById($id);
            //dump($post);
            
        } else exit('$id - пустой');

        if(isset($_POST['submit'])){
            $label = $_POST['label'];
            $text = $_POST['text'];
            $status = $_POST['status'];
            $errors = false;

            if (!isset($label) || !isset($text)) {
                $errors[] = 'Заполните поля';
            }

            if ($errors == false) {
                if(Blog::updatePost($id, $label, $text, $status))
                    header("Location: /");
                else exit('Ошибка при обновлении поста');
            }
        }

        require_once(ROOT. '/views/cabinet/redact.php');
        return true;
    }
}