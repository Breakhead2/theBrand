<?php

function sendSub($email){
    return executeSql("INSERT INTO subscribers (`email`) VALUES ('{$email}');");
}

function checkSub($email){
    return getOneResult("SELECT * FROM subscribers WHERE email = '{$email}'");
}