<?php
//in developer mode

class BlogController
{
    public function actionIndex()
    {
        $blogList = Blog::getBlogList();
        require_once(ROOT . '/views/blog/index.php');

        return true;
    }

    public function actionView($id)
    {
        if ($id) {
            $newsItem = Blog::getNewsItemById($id);
            require_once(ROOT . '/views/blog/view.php');
        }

        return true;
    }

    public function actionCreate()
    {
        $label='';
        $text='';
        $status='';
        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $label = $_POST['label'];
            $text =  $_POST['text'];
            $status = $_POST['status'];
            $userId= User::checkLogged();
            $errors = false;
            // При необходимости можно валидировать значения нужным образом
            if (!isset($label) || !isset($text)) {
                $errors[] = 'Заполните поля';
            }

            if ($errors == false) {
                // Если ошибок нет
                // Добавляем пост
                
                Blog::createPost($label,$text,$status,$userId);
                header("Location: /");
                // echo $postId;
                // // Если запись добавлена
                // if ($postId) {
                //     // Проверим, загружалось ли через форму изображение
                //     if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                //         // Если загружалось, переместим его в нужную папке, дадим новое имя
                //         move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/products/{$id}.jpg");
                //     }
                // };

                // Перенаправляем пользователя на страницу личного кабинета
                
            }
        }

        // Подключаем вид
        require_once(ROOT . '/views/blog/createnew.php');
        return true;
    }
}
