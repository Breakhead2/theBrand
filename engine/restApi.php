<?php

function restApi ($action): array
{
    $answer = [];

    switch($action){

        case 'add':
            $data = json_decode(file_get_contents('php://input'));
            $productId = $data->product_id;
            $title = $data->title;
            $price = $data->price;
            $color = $data->color;
            $size = $data->size;
            $session_id = session_id();
            $item = getCurrentItem($productId, $session_id, $color, $size);
            if(!is_null($item)){
                changeQuantity($item['id'], 'add');
                $answer['status'] = 'changed';
            }else{
                $rows = addToCart($productId, $title, $price, $session_id, $color, $size);
                increasePopularity($productId);
                $answer['rows'] = $rows;
                $answer['status'] = 'new';
            }

            $quantity = getCartQuantity($session_id)['quantity'];
            $total_price = getTotalPrice($session_id)['total_price'];
            $answer['quantity'] = $quantity;
            $answer['totalPrice'] = $total_price;
            $answer['item'] = getCurrentItem($productId, $session_id, $color, $size);
            break;

        case 'delete':
            $data = json_decode(file_get_contents('php://input'));
            $id = $data->cartId;
            $session_id = session_id();
            deleteFromCart($id);

            $answer['status'] = 'deleted';
            $answer['quantity'] = getCartQuantity($session_id)['quantity'];
            $answer['totalPrice'] = getTotalPrice($session_id)['total_price'];
            break;

        case 'change':
            $data = json_decode(file_get_contents('php://input'));
            if(!isset($data->change)){
                $cartId = $data->cartId;
                $value = $data->value;
                $session_id = session_id();
                changeQuantity($cartId, 'change',$value);
                $item = getCartItem($cartId);
                $answer['status'] = 'changed';
                $answer['item'] = $item;
                $answer['quantity'] = getCartQuantity($session_id)['quantity'];
                $answer['totalPrice'] = getTotalPrice($session_id)['total_price'];
            }else{
                $cartId = $data->cart_id;
                $type = $data->change;
                $value = $data->value;
                change($cartId, $type, $value);
                $answer['status'] = 'changed';
                break;
            }
            break;

        case 'clearcart':
            $session_id = session_id();
            clearCart($session_id);
            $answer['status'] = 'cart clear';
            break;

        case 'offer':
            $data = json_decode(file_get_contents('php://input'));
            $session_id = session_id();
            $country = safety($data->country);
            $city = safety($data->city);
            $postcode = safety($data->postcode);
            $fio = safety($data->fio);
            $phone = $data->phone;
            $email = safety($data->email);
            $row = createOrder($session_id, $country, $city, $postcode, $fio, $phone, $email);
            $answer['status'] = 'success';
            $answer['row'] = $row;
            session_regenerate_id();
            break;

        case 'subs':
            $data = json_decode(file_get_contents('php://input'));
            $email = safety($data->email);
            if(is_null(checkSub($email))){
                sendSub($email);
                $answer['status'] = 'success';
            }else{
                $answer['status'] = 'already have';
            }
            break;

        case 'filter':
            $data = json_decode(file_get_contents('php://input'));
            $type = safety($data->type);
            $category = safety($data->category);
            $windowWidth = $_SESSION['window'];
            $answer['catalog'] = filter($type,$category, $windowWidth);
            $answer['status'] = 'success';
            break;

        case 'window':
            $data = json_decode(file_get_contents('php://input'));
            $_SESSION['window'] = $data->window;
            break;

        case 'more':
            $data = json_decode(file_get_contents('php://input'));
            $page = $data->page;
            $windowWidth = $data->windowWith;
            $category = $data->category;
            $type = $data -> type;
            $catalog_length = $data->catalog_length;

            if(!is_null($type)){
               $catalog = filter($type, $category, $windowWidth, $page);
            }else{
                $catalog = getCatalog($category, $windowWidth, $page);
            }
            $answer['catalog_length'] = $catalog_length;
            if($catalog_length !== count($catalog)){
                $answer['catalog'] = $catalog;
                $answer['page'] = $page + 1;
                $answer['status'] = 'success';
            }else{
                $answer['status'] = 'stop';
            }
            break;
    }
    return $answer;
 }