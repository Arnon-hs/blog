<?php

class ApiController
{
    public function actionBlog($params=NULL)//сделать с модулем
    {
        // var_dump($params);
        if ($params!=NULL)
            require_once(ROOT . '/views/api/index.php');
        else exit('Не верно указаны параметры запроса');
        return true;
    }

    public function actionUsers($request)
    {
        require_once(ROOT . '/views/api/users-'.$request.'.php' );
        return true;
    }

}
