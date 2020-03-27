<?php

return array(
    // Админпанель:
    'admin' => 'admin/index',
    // Post
    'post/view/([a-zA-Z0-9_]+)' => 'blog/view/$1', // actionView в BlogController
    // Каталог
    'catalog' => 'catalog/index', // actionIndex в CatalogController
    // Пользователь
    'user/register' => 'user/register',
    'user/login' => 'user/login',
    'user/logout' => 'user/logout',
    //'user/history' => 'user/history',
    'cabinet/edit' => 'cabinet/edit',
    'cabinet/redact/([a-zA-Z0-9_]+)' => 'cabinet/redact/$1',
    'cabinet/history' => 'cabinet/history',
    'cabinet/stat' => 'cabinet/stat',
    'cabinet' => 'cabinet/index',
    //blog
    'post/create' => 'blog/create',
    //api
    'api/post/([a-zA-Z0-9_]+)' => 'api/blog/$1',//доделать апи!!!!!!!!!!![0-9]+
    'api/users/([a-zA-Z0-9_]+)' => 'api/users/$1', //actionUsers ApiController
    '' => 'site/index', // actionIndex в SiteController
);
