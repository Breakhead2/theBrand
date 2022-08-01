<section class="banner">
        <div class="banner__container">
            <div class="banner__image">
                <img src="/images/header_banner.png" alt="banner" />
            </div>
            <div class="banner__textBlock">
                <p class="banner__text big">THE BRAND</p>
                <p class="banner__text">
                    РОСКОШНАЯ
                    <span class="banner__text red">ОДЕЖДА</span>
                </p>
            </div>
        </div>
    </section>

<section class="offers">
        <div class="offers__container">
            <div class="imageContainer__short">
                <img src="/images/offers_image01.png" alt="offer image" />
                <div class="textContainer">
                    <span class="textContainer__text">30% скидка</span>
                    <span class="textContainer__text__bigred">для женщин</span>
                </div>
            </div>
            <div class="imageContainer__short">
                <img src="/images/offers_image02.png" alt="offer image" />
                <div class="textContainer">
                    <span class="textContainer__text">горячие предложения</span>
                    <span class="textContainer__text__bigred">для мужчин</span>
                </div>
            </div>
            <div class="imageContainer__short">
                <img src="/images/offers_image03.png" alt="offer image" />
                <div class="textContainer">
                    <span class="textContainer__text">новые предложения</span>
                    <span class="textContainer__text__bigred">для детей</span>
                </div>
            </div>
            <div class="imageContainer__long">
                <img src="/images/offers_image04.png" alt="offer image" />
                <div class="textContainer">
                <span class="textContainer__text"
                >роскошные и модные тренды</span
                >
                    <span class="textContainer__text__bigred">аксессуаров</span>
                </div>
            </div>
        </div>
    </section>

<section class="products">
        <div class="products__container">
            <h3 class="products_heading">Популярные товары</h3>
            <p class="products_paragraph">
                Покупайте товары на основе того, что мы представили на этой неделе
            </p>
            <div class="productsBox">
                <?php foreach ($featured as $item): ?>
                    <?php include "./templates/components/productItem.php" ?>
                <?php endforeach; ?>
            </div>
            <a href="/catalog/featured" class="products_allItems"
            >Популярные продукты</a
            >
        </div>
    </section>

<?=$guarantees?>

<?=$review?>


