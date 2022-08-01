<div class="cartItem" data-cartId="<?=$item['id']?>">
    <a href="/product/<?=$item['product_id']?>">
        <img src="/images/catalog/<?=$item['product_id']?>.jpg" alt="item image" />
    </a>
    <div class="cartItem__info">
        <h3 class="cartItem__info__title"><?=$item['title']?></h3>
        <div class="cartItem__info__price">
            <?php if($item['color']) :?>
                <p style="margin-bottom:5px">Цвет:
                    <span id="color"><?=$item['color']?></span>
                </p>
            <?php endif; ?>
            <?php if($item['color']) :?>
                <p style="margin-bottom:5px">Размер:
                    <span id="size"><?=$item['size']?></span>
                </p>
            <?php endif; ?>
            <p style="margin-bottom:5px">Количество:
                <span id="quantity"><?=$item['quantity']?></span>
            </p>
			<p>Цена: <span id="price"><?=$item['price']?></span> &#x20bd </p>
		</div>
    </div>
</div>