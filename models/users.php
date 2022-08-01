<?php
function getUserByEmail($email){
    return getOneResult("SELECT * FROM users WHERE email = '{$email}'");
}

function getUserById($id){
    return getOneResult("SELECT * FROM users WHERE id = {$id}");
}

function createUser($name, $surname, $gender, $email, $password){
    return executeSql("INSERT INTO users (name, surname, gender, email, password) VALUES ('{$name}', '{$surname}', '{$gender}', '{$email}', '{$password}')");
}

function editUser($arr){
    $query = [];
    foreach ($arr as $field => $value){
        $query[]= $field . " = '{$value}'";
    }

    $query = implode(", ", $query);
    return executeSql("UPDATE users SET " . $query . " WHERE id = '{$_SESSION['user']}'");
}