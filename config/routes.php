<?php

return array(
    // Админпанель:
    'admin' => 'admin/index',
    // Post
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
    //api
    'api/post/([a-z]+)' => 'api/blog/$1',//доделать апи!!!!!!!!!!![0-9]+
    'api/users/([a-z]+)' => 'api/users/$1', //actionUsers ApiController
    '' => 'site/index', // actionIndex в SiteController
);
