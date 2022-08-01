<?php


function validation($type, $value){
    switch ($type){
        case 'phone':
            $includes = ['+', '-', ' ', '(', ')'];
            return str_replace($includes, '', $value);;
        default:
            return false;
    }
}

function loadImage()
{
    $status = true;
    mkdir(PROFILE_IMG . $_SESSION['user'], 0700);
    $path = PROFILE_IMG . "{$_SESSION['user']}/" . $_FILES['profile_photo']['name'];
    if($_FILES['profile_photo']['type'] !== 'image/png' && $_FILES['profile_photo']['type'] !== 'image/jpeg'){
        $_SESSION['error'] = "Ошибка типа, можно загружать только файлы формата JPG или PNG";
        $status = false;
    }elseif ($_FILES['profile_photo']['size'] > 500000){
        $_SESSION['error'] = "Файл должен быть меньше 500КБ";
        $status = false;
    }
    if ($status){
        unset($_SESSION['error']);
        move_uploaded_file($_FILES['profile_photo']['tmp_name'], $path);
    }else{
        header("Location:" . $_SERVER['HTTP_REFERER']);
        die();
    }
}

function checkChanges($profile): array
{
    $filtered = [];
    foreach ($profile as $key => $value){
        if ($value === ''){
            $profile[$key] = null;
        }
    }
    $user = getUserById($_SESSION['user']);
    foreach ($profile as $field => $value){
        if($user[$field] !== $value){
            $filtered[$field] = $value;
        }
    }

    return $filtered;
}