<section class="reviewsAndSub">
    <div class="reviewsAndSub__container">
        <div class="reviewContainer">
            <div class="review">
                <?php if(!is_null($review)): ?>
                    <?php foreach ($review as $item): ?>
                        <div class="review_item">
                            <div class="review__imageContainer">
                                <img src="/images/users/<?=$item['id_user']?>/<?=$item['photo_name']?>" alt="user_photo" />
                            </div>
                            <div class="review__textContainer">
                                <p class="review__textContainer_text"><span> <?=$item['name'] . " " . $item['surname']?></span></p>
                                <p class="review__textContainer_text" style="font-size: inherit">
                                    <?=$item['review']?>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <h3 style="font-size: inherit; font-weight: bold"> Отзывы: </h3>
                    <p style="align-self: center"> Отзывов нет </p>
                <?php endif; ?>
            </div>
        </div>
        <div class="subscribeForm">
            <p class="subscribeForm__text">
                <span class="subscribeForm__text_bold">ПОДПИСАТЬСЯ</span>
                На наш каталог и обновления товаров
            </p>
            <form id="form" method="post" novalidate>
                <div style="display: flex; height: 100%">
                    <input id="email_sub" name="email" type="email" placeholder="Укажите ваш email" />
                    <button id="btn_sub" type="submit">Подписаться</button>
                </div>
                <p class="error_subs"></p>
            </form>
        </div>
    </div>
</section>