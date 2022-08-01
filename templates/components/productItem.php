<div class="productsItem" data-id="<?=$item['id']?>">
    <a href="/product/<?=$item['id']?>" class="productsItem imageContainer">
        <img
                src="/images/catalog/<?=$item['id']?>.jpg"
                alt="image product"
        />
    </a>
    <div class="productsItem__textContainer">
        <h4 class="productsItem__textContainer__heading" id="title">
            <?=$item['title']?>
        </h4>
        <p class="productsItem__textContainer__text">
            <?=$item['description']?>
        </p>
    </div>
    <div class="productsItem__button">
        <p class="productsItem__button_price"> <span id="price"><?=$item['price']?></span> &#x20bd</p>
    </div>
</div>