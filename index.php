<?php
session_start();

//подключение конфига
require "./config/config.php";

//данные по умолчанию

$action = "";
$data = [];

if($_COOKIE['user']){
    $user = getUserById($_COOKIE['user']);
    $_SESSION['login'] = $user['name'];
    $_SESSION['user'] = $user['id'];
}

$array_url = explode('/', $_SERVER['REQUEST_URI']);

if($array_url[1] == ""){
    $page = "index";
}else{
    $page = $array_url[1];
    $action = $array_url[2];
}

$data = router($page, $array_url, $action);

echo render($data["page"], $data["params"]);