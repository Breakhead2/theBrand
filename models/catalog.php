<?php

function getCatalog($category, $windowWidth, $page = 0){
    if($windowWidth > 768){
        $quantity = $page * 4 + 4;
        if($category === 'featured'){
            return getAssocResult("SELECT * FROM catalog ORDER BY popularity DESC LIMIT 0 , {$quantity}");
        }
        return getAssocResult("SELECT * FROM catalog WHERE category = '{$category}' LIMIT 0, {$quantity}");
        }else{
        $quantity = $page * 3 + 3;
            if($category === 'featured'){
                return getAssocResult("SELECT * FROM catalog ORDER BY popularity DESC LIMIT 0 , {$quantity}");
            }
            return getAssocResult("SELECT * FROM catalog WHERE category = '{$category}'  LIMIT 0, {$quantity}");
        }
}

function getFeaturedProducts($windowWith){
    if($windowWith > 768){
        return getAssocResult("SELECT * FROM catalog ORDER BY popularity DESC LIMIT 8");
    }else{
        return getAssocResult("SELECT * FROM catalog ORDER BY popularity DESC LIMIT 6");
    }
}

function getProduct($id){
    return getOneResult("SELECT * FROM catalog WHERE id = {$id}");
}

function filter($type, $category, $windowWidth, $page = 0){
    if($windowWidth > 768) {
        $quantity =  $page * 4 + 4;
        if($category === 'featured'){
            return getAssocResult("SELECT * FROM catalog WHERE types = '{$type}' ORDER BY popularity DESC  LIMIT 0 , {$quantity}");
        }
        return getAssocResult("SELECT * FROM catalog WHERE category = '{$category}' AND types = '{$type}' LIMIT 0, {$quantity}");
    }else{
        $quantity = $page * 3 + 3;
        if($category === 'featured'){
            return getAssocResult("SELECT * FROM catalog WHERE types = '{$type}' ORDER BY popularity DESC  LIMIT 0 , {$quantity}");
        }
        return getAssocResult("SELECT * FROM catalog WHERE category = '{$category}' AND types = '{$type}' LIMIT 0, {$quantity}");
    }
}

function getCatalogBySearch($windowWidth, $word, $page = 0){
    if($windowWidth > 768){
        $quantity = $page * 4 + 4;
    }else{
        $quantity = $page * 3 + 3;
    }
    var_dump("SELECT * FROM catalog WHERE description LIKE % {$word} % LIMIT 0 , {$quantity}");
    return getAssocResult("SELECT * FROM catalog WHERE description LIKE '%{$word}%' LIMIT 0 , {$quantity}");
}

function recommendation($category, $type, $windowWidth, $product_id){
    if($windowWidth > 768) {
        return getAssocResult("SELECT * FROM catalog WHERE category = '{$category}' AND types = '{$type}' AND id != {$product_id} LIMIT 0, 4");
    }
    return getAssocResult("SELECT * FROM catalog WHERE category = '{$category}' AND types = '{$type}' AND id != {$product_id} LIMIT 0, 3");
}