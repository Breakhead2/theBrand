<?php
function createOrder($session_id, $country, $city, $postcode, $fio, $phone, $email, $login = null){
    if(is_null($login)){
        return executeSql("INSERT INTO offers (session_id, country, city, postcode, fio, phone, email) VALUES ('{$session_id}', '{$country}', '{$city}', $postcode, '{$fio}', '{$phone}', '{$email}')");
    }
//   return executeSql("INSERT INTO offers (session_id, login, country, city, postcode, fio, phone, email) VALUES ($session_id, $login, $country, $city, $postcode, $fio, $phone, $email)");
}