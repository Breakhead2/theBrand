<?php
function auth($email, $pass): bool
{
    $user = getUserByEmail($email);

    if(!$user){
        $_SESSION['error'] = 'Вы не зарегестрированы или ввели неверные данные';
        return false;
    }

    if(!password_verify($pass, $user['password'])){
        $_SESSION['error'] = 'Ошибка авторазиции';
        return false;
    }

    if($_POST['remember'] === 'on'){
        setcookie("user", $user['id'], time() + 3600, "/");
    }

    unset($_SESSION['error']);
    $_SESSION['login'] = $user['name'];
    $_SESSION['user'] = $user['id'];

    return true;
}

function signup($name, $surname, $gender, $email, $password): bool
{
    $user = getUserByEmail($email);

    if($user){
        $_SESSION['error'] = 'У вас уже есть аккаунт';
        return false;
    }

    unset($_SESSION['error']);
    $password = password_hash($password, PASSWORD_DEFAULT);
    createUser($name, $surname, $gender, $email, $password);

    $user = getUserByEmail($email);
    $_SESSION['login'] = $name;
    $_SESSION['user'] = $user['id'];

    mkdir(PROFILE_IMG . $_SESSION['user'], 0700);
    $path = PROFILE_IMG . "{$_SESSION['user']}/" . "default.png";
    copy(IMAGES . "default.png", $path);

    return true;
}