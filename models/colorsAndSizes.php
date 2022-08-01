<?php

function getColors($product_id){
    $array = getOneResult("SELECT * FROM colors WHERE id_product = {$product_id}");
        if(empty($array)) return [];
    return seive($array);
}

function getSizes($product_id){
    $array = getOneResult("SELECT * FROM sizes WHERE id_product = {$product_id}");
        if(empty($array)) return [];
    return seive($array);
}

function seive($arr){
    $array = [];
    foreach ($arr as $key => $value){
        if($value === '+') $array[$key] = $value;
    }
    return $array;
}