<?
if(!isset($_COOKIE['userId'])){
    $userId = rand(1000, 9999) . '-' . time();
    setcookie('userId', $userId, time()+31536000, '/');
}
echo $_SERVER['REQUEST_URI'];