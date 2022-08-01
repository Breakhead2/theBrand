<section class="gallery">
        <button class="btn_gallery" id="btn_left">
            <i class="fas fa-chevron-up"></i>
        </button>
        <div class="gallery__container">
            <div class="imageContainer" data-images="<?=$images?>">
                <img 
				src="/images/catalog/items_image/<?=$data['id']?>/<?=$data['id']?>_1.jpg" 
				alt="item image"
				data-id="<?=$data['id']?>"
				/>
            </div>
        </div>
        <button class="btn_gallery" id="btn_right">
            <i class="fas fa-chevron-up"></i>
        </button>
    </section>

<section class="itemInfo">
        <div class="itemInfo__container">
            <div class="itemInfoBox" data-item="<?=$data['id']?>">
                <div class="itemDescription">
                    <h4 class="itemDescription__collection"><?=$data['category']?> collection</h4>
                    <h3 class="itemDescription__title"><?=$data['title']?></h3>
                    <p class="itemDescription__description">
                        <?=$data['description']?>
                    </p>
                    <p class="itemDescription__price"> <span><?=$data['price']?></span>  &#x20bd</p>
                </div>
                <form class="itemForm" id="colors_sizes_form">
                    <span class="error"></span>
                    <div class="itemForm__tools" <?php if(empty($colors) || empty($sizes)): ?> style="gap: 0px <?php endif;?>">
                        <?php if(!empty($colors)) : ?>
                            <div class="itemForm__tool" box="box">
                                <h4 class="itemForm__tool_heading" active="active">
                                    Выбрать цвет <i class="fas fa-chevron-down"></i>
                                </h4>
                                <ul class="itemForm__tool_list" data-id="colors">
                                    <?php foreach ($colors as $key => $value) : ?>
                                    <li class="itemForm__tool_list_item">
                                        <label>
                                            <input type="radio" name="color" data-color="<?=$key?>" /><?=ucfirst($key)?>
                                        </label>
                                    </li>
                                    <?php endforeach;?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <?php if(!empty($sizes)) : ?>
                            <div class="itemForm__tool" box="box" data-id="sizes">
                                <h4 class="itemForm__tool_heading" active="active">
                                    Выбрать размер <i class="fas fa-chevron-down"></i>
                                </h4>
                                <ul class="itemForm__tool_list">

                                    <?php foreach ($sizes as $key => $value) : ?>
                                    <li class="itemForm__tool_list_item">
                                        <label>
                                            <input type="radio" name="size" data-size="<?=$key?>" /><?=$key?>
                                        </label>
                                    </li>
                                    <?php endforeach;?>

                                </ul>
                            </div>
                        <?php endif; ?>

                    </div>
                    <button class="itemForm__addToCart" id="add_cart_product">
                        <i class="fas fa-shopping-cart"></i>В корзину
                    </button>
                </form>
            </div>
        </div>
    </section>

<?php if(!empty($another)): ?>
<section class="products">
        <div class="products__container">
            <div class="productsBox">
                <?php foreach($another as $item): ?>
                    <?php include "./templates/components/productItem.php" ?>
                <?php endforeach; ?>
            </div>
        </div>
</section>
<?php endif; ?>

<?=$review?>

<script>
	let images = JSON.parse('<?php echo json_encode($images); ?>'); // массив картинок
	let image = document.querySelector('.imageContainer img');
	let btn_forward = document.querySelector('#btn_right');
	let btn_back = document.querySelector('#btn_left');
	
	btn_forward.addEventListener('click', ()=>{
		let path = image.getAttribute('src').split('/').splice(0, 5).join('/') + '/';
		let currentImg = image.getAttribute('src').split('/').pop();
		let index = images.indexOf(currentImg);
		
		if(images[index + 1] === undefined){
			index = 0;
			image.src = path + images[index];
		}else{
			index++;
			image.src = path + images[index];
		}
	});
	
	btn_back.addEventListener('click', ()=>{
		let path = image.getAttribute('src').split('/').splice(0, 5).join('/') + '/';
		let currentImg = image.getAttribute('src').split('/').pop();
		let index = images.indexOf(currentImg);
		
		if(images[index - 1] === undefined){
			index = images.length - 1;
			image.src = path + images[index];
		}else{
			index--;
			image.src = path + images[index];
		}
	});
	

</script>