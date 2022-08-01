<section class="filterTools">
        <div class="filterTools__container">
            <div class="filterBox" box="box">
                <p class="filterBox__title" active="active">
                    Фильтер<i class="fas fa-sort"></i>
                </p>

                <div class="filterBox__details">
                        <ul class="filterBox__details_list">
                            <li>
                                <a class="filterBox__details_link" id="accessories">Аксессуары</a>
                            </li>
                            <li>
                                <a class="filterBox__details_link" id="bags">Сумки</a>
                            </li>
                            <li>
                                <a class="filterBox__details_link" id="suits">Костюмы</a>
                            </li>
                            <li>
                                <a class="filterBox__details_link" id="HaS">Худи и свитера</a>
                            </li>
                            <li>
                                <a class="filterBox__details_link" id="JaC">Куртки и пальто</a>
                            </li>
                            <li>
                                <a class="filterBox__details_link" id="polo">Поло</a>
                            </li>
                            <li>
                                <a class="filterBox__details_link" id="shirts">Рубашки</a>
                            </li>
                            <li>
                                <a class="filterBox__details_link" id="shoes">Обувь</a>
                            </li>
                            <li>
                                <a class="filterBox__details_link" id="t-shirts">Футболки</a>
                            </li>
                            <li>
                                <a class="filterBox__details_link" id="PaJ">Брюки и Джинсы</a>
                            </li>
                        </ul>
                </div>
            </div>
        </div>
    </section>

<section class="products">

        <div class="products__container">
            <?php if(empty($catalog)) : ?>
                <div class="productsBox" style="grid-template: auto/minmax(227px, 1fr) ">
                    <p style="text-align: center">К сожалению, у нас отсутствуют данные товары.</p>
                </div>
                <div class="pagination" style="display:none;">
                    Загрузить еще
                </div>
            <?php else : ?>
                <div class="productsBox">
                    <?php foreach($catalog as $item): ?>
                        <?php include "./templates/components/productItem.php" ?>
                    <?php endforeach; ?>
                </div>
                <?php if(!$_SESSION['search']):?>
                    <div class="pagination" data-page="1">
                        Загрузить еще
                    </div>
                <?php endif; ?>
            <?php endif; ?>

        </div>
    </section>

<?=$guarantees?>

<?=$review?>


