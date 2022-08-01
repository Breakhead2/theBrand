<?php

//подключение

function getConnect(){
    static $link = null;
    if(is_null($link)){
        $link = @mysqli_connect(HOST, USER, PASS, DB_NAME) or die("Ошибка подключения к БД" . mysqli_connect_error());
    }
    return $link;
}

//Исключаем инъекции

function safety($data)
{
    $db = getConnect();
    return mysqli_real_escape_string($db, strip_tags(stripslashes($data)));
}

//получение ассоциативного массива данных

function getAssocResult($sql){
    $result = @mysqli_query(getConnect(),$sql) or die(mysqli_error(getConnect()));
    $array_result = [];

    while($row = mysqli_fetch_assoc($result)){
        $array_result[] = $row;
    }

    return $array_result;
}

//получение одной запаписи

function getOneResult($sql){
    $result = @mysqli_query(getConnect(), $sql) or die(mysqli_error(getConnect()));
    return mysqli_fetch_assoc($result);
}

//выполнение запроса

function executeSql($sql){
    @mysqli_query(getConnect(), $sql) or die(mysqli_error(getConnect()));
    return mysqli_affected_rows(getConnect()); // кол-во затронутых записей в БД
}