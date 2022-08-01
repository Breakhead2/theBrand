<?php

function getCart($session_id){
	return getAssocResult("SELECT * FROM cart WHERE session_id = '{$session_id}'");
}

function getCurrentItem($product_id, $session_id, $color, $size){
	return getOneResult("SELECT * FROM cart WHERE product_id = {$product_id} AND session_id = '{$session_id}' AND color = '{$color}' AND size = '{$size}'");
}

function clearCart($session_id){
    return executeSql("DELETE FROM cart WHERE session_id = '{$session_id}'");
}

function getCartItem($cart_id){
	return getOneResult("SELECT id, price, product_id, quantity, title FROM cart WHERE id = $cart_id");
}

function changeQuantity($cart_id, $type, $value = null){
	if ($type === 'add'){
		return executeSql("UPDATE cart SET quantity = quantity + 1 WHERE id = $cart_id ");
	}else{
		return executeSql("UPDATE cart SET quantity = $value WHERE id = $cart_id ");
	}
}

function change($cart_id, $type, $value){
    return executeSql("UPDATE cart SET $type = '{$value}' WHERE id = $cart_id");
}

function getCartQuantity($session_id){
	return getOneResult("SELECT SUM(quantity) as quantity FROM cart WHERE session_id = '{$session_id}'");
}

function getTotalPrice($session_id){
	return getOneResult("SELECT SUM(quantity * price) as total_price FROM cart WHERE session_id = '{$session_id}'");
}

function addToCart($product_id, $title, $price, $session_id, $color, $size){
	return executeSql("INSERT INTO cart (product_id, title, price, session_id, color, size) VALUES($product_id, '{$title}', $price, '{$session_id}', '{$color}', '{$size}')");
}

function deleteFromCart($cart_id){
	return executeSql("DELETE FROM cart WHERE id = $cart_id");
}

function increasePopularity($product_id){
    return executeSql("UPDATE catalog SET popularity = popularity + 1 WHERE id = {$product_id}");
}