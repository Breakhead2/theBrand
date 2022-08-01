<div class="cartContainer">
    <div class="cartBox">
	<?php if(!empty($data)): ?>
		<?php foreach($data as $item): ?>
		    <?php include "./templates/components/cartItem.php" ?>
        <?php endforeach; ?>
	<?php else: ?>
		<p>Корзина пуста</p>
	<?php endif; ?>
    </div>

    <div class="totalPrice">
        <span class="totalPrice__text">итого:</span>
		<div>
			<span id="total_price">
				<?php if(!is_null($total_price)):?>
					<?=$total_price?>
				<?php else: ?>
					<?="0"?>
				<?php endif; ?>
			</span>
			&#x20bd
		</div>
    </div>

    <a href="/cart" class="cartBtn">перейти в корзину</a>
</div>