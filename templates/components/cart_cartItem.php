<div class="cardBox__cards_item" data-cartId="<?=$item['id']?>">
                        <a
                            href="/product/<?=$item['product_id'] ?>"
                            class="cardBox__cards_item_imageContainer"
                        >
                            <img
                                src="/images/catalog/<?=$item['product_id']?>.jpg"
                                alt="item_image"
                            />
                        </a>
                        <div class="cardBox__cards_item_information">
                            <h3 class="cardBox__cards_item_information_title">
                                <?=$item['title']?>
                            </h3>
                            <ul class="cardBox__cards_item_information_list">
                                <li>Цена: <span id="price"><?=$item['price']?></span> &#x20bd</li>
                                <?php if(!empty($colors['product_id'])) : ?>
                                <li>
                                    <label for="color">Цвет:
                                        <select data-name="color">
                                            <?php foreach ($colors[$item['product_id']] as $key => $size) : ?>
                                                <?php if ($item['color'] === $key) : ?>
                                                    <option selected><?=$key?></option>
                                                <?php else :?>
                                                    <option><?=$key?></option>
                                                <?php endif; ?>
                                            <?php endforeach;?>
                                        </select>
                                    </label>
                                </li>
                                <?php endif; ?>

                                <?php if(!empty($sizes[$item['product_id']])) :?>
                                <li>
                                    <label for="size">Размер:
                                        <select data-name="size">
                                            <?php foreach ($sizes[$item['product_id']] as $key => $size) : ?>
                                                <?php if ($item['size'] === $key) : ?>
                                                    <option selected><?=$key?></option>
                                                <?php else :?>
                                                    <option><?=$key?></option>
                                                <?php endif; ?>
                                            <?php endforeach;?>
                                        </select>
                                    </label>
                                </li>
                                <?php endif; ?>
                                <li>
                                    Количество:
                                    <input type="number" data-id="<?=$item['id']?>" value="<?=$item['quantity']?>" id="inputQuantity" />
                                </li>
                            </ul>
                        </div>
                        <button class="cardBox__cards_item_btnDelete">
                            <i class="fas fa-times-circle" id="cartBtnDlt"></i>
                        </button>
</div>