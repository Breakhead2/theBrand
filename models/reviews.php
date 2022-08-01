<?php


function createReview($id_user, $name, $surname, $photo_name, $review){
    return executeSql("INSERT INTO reviews (id_user, name, surname, photo_name, review) VALUES ($id_user, '{$name}', '{$surname}', '{$photo_name}', '{$review}')");
}

function getReviews(){
    return getAssocResult("SELECT * FROM reviews ORDER BY id DESC LIMIT 3");
}