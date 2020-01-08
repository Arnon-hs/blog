<?php

class SiteController
{

    public function actionIndex()
    {
        $cursor=User::findAllUser();
        $posts = Blog::getBlogList();
        require_once(ROOT . '/views/site/index.php');
        return true;
    }
    public function actionAbout()
    {
        // Подключаем вид
        require_once(ROOT . '/views/info/about.php');
        return true;
    }
    public function actionServices()
    {
        require_once(ROOT. '/views/info/services.php');
        return true;
    }
}
