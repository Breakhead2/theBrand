
<section class="cards">
            <?php if(empty($data)) : ?>
                 <div class="cards__container" style="grid-template: auto/1fr">
                    <p style = "text-align: center; font-family: inherit; font-size: 20px">Корзина пуста</p>
                 </div>
            <?php else: ?>
            <div class="cards__container">
                <div class="cardBox">
                    <div class="cardBox__cards">
                        <?php foreach ($data as $item): ?>
                            <?php include "./templates/components/cart_cartItem.php" ?>
                        <?php endforeach; ?>
                    </div>

                    <div class="cardBox__buttons">
                        <button class="cardBox__buttons_btnClear">
                            Очистить корзину
                        </button>
                    </div>
                </div>

                <div class="formBox">
                    <form class="formBox__form" id="myForm" novalidate>
                        <h4 class="formBox__form_title">Заполните форму</h4>
                        <ul class="formBox__form_list">
                            <li>
                                <label for="country">
                                    <input type="text" placeholder="Страна" name="country" id="country" value="<?=$user['country']?>" required>
                                    <span class="error" aria-live="polite"></span>
                                </label>
                            </li>
                            <li>
                                <label for="city">
                                    <input type="text" placeholder="Город" name="city" id="city" value="<?=$user['city']?>" required>
                                    <span class="error" aria-live="polite"></span>
                                </label>
                            </li>
                            <li>
                                <label for="postcode">
                                    <input type="text" placeholder="Почтовый индекс" name="postcode" id="postcode" value="<?=$user['postcode']?>" maxlength="6" required>
                                    <span class="error" aria-live="polite"></span>
                                </label>
                            </li>
                            <li>
                                <label for="fio">
                                    <?php if(isset($user['name'])) : ?>
                                        <input type="text"  placeholder="Имя Фамилия" name="fio" id="fio" value="<?=$user['name'] . " " . $user['surname']?>" required>
                                    <?php else: ?>
                                        <input type="text"  placeholder="Имя Фамилия" name="fio" id="fio" required>
                                    <?php endif; ?>
                                    <span class="error" aria-live="polite"></span>
                                </label>
                            </li>
                            <li>
                                <label for="phone">
                                    <input type="text"  placeholder="Телефон" name="phone" id="phone" value="<?=$user['phone']?>" data-validate-field="phone" required>
                                    <span class="error" aria-live="polite"></span>
                                </label>
                            </li>
                            <li>
                                <label for="email">
                                    <input type="email" placeholder="Email" name="email" id="email" value="<?=$user['email']?>" minlength="8" required>
                                    <span class="error" aria-live="polite"></span>
                                </label>
                            </li>
                         </ul>

                        <div class="formBox__check">
                            <div class="formBox__check_priceBlock">
                                <p class="formBox__check_priceBlock_totalPrice">
                                    Общая стоимость: <span id="totalPrice">
                                        <?php if(!is_null($total_price)):?>
                                            <?=$total_price?>
                                        <?php else: ?>
                                            <?="0"?>
                                        <?php endif; ?>
                                    </span>
                                    &#x20bd
                                </p>
                            </div>
                            <button type="submit" class="formBox__check_btn" id="btn_checkout">Оформить заказ</button>
                        </div>
                    </form>
                </div>

            </div>
            <?php endif; ?>

</section>
<?=$review?>

