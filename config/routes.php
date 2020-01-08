<?php

return array(
    // Админпанель:
    'admin' => 'admin/index',
    // Товар
    'blog/([0-9]+)' => 'blog/view/$1', // actionView в BlogController
    // Каталог
    'catalog' => 'catalog/index', // actionIndex в CatalogController
    // Пользователь
    'user/register' => 'user/register',
    'user/login' => 'user/login',
    'user/logout' => 'user/logout',
    //'user/history' => 'user/history',
    'cabinet/edit' => 'cabinet/edit',
    'cabinet' => 'cabinet/index',
    //blog
    'post/create' => 'blog/create',
    '' => 'site/index', // actionIndex в SiteController
);
