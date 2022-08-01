<div class="header">
    <div class="header__container">
        <a class="logo" href="/" class="logo">
            <img src="/images/logo.png" alt="logotype" />
        </a>

        <?= $menu ?>
        <?php if(isset($_SESSION['login'])) :?>
            <div class="buttons login">
                <div class="fas fa-search" id="search_btn"></div>
                <a href="/profile/<?=$_SESSION['user']?>" class="fas fa-user" style="color:#F16D7F;" id="user_btn"></a>
                <div class="fas fa-shopping-cart" id="cart_btn">
                <div class="cartIdentificator">
                    <span id="quantityItemsInCard">
						<?php if(!is_null($quantity)):?>
							<?=$quantity?>
						<?php else: ?>
							<?="0"?>
						<?php endif; ?>
					</span>
                </div>
            </div>
                <div class="fas fa-bars" id="menu_btn"></div>
                <form action="/logout" method="post">
                    <button type="submit"><i class="fa-solid fa-right-from-bracket" id="logout"></i></button>
                </form>
            </div>
        <?php else : ?>
            <div class="buttons">
                <div class="fas fa-search" id="search_btn"></div>
                <a href="/enter" class="fas fa-user" id="user_btn"></a>
                <div class="fas fa-shopping-cart" id="cart_btn">
                <div class="cartIdentificator">
                    <span id="quantityItemsInCard">
						<?php if(!is_null($quantity)):?>
                            <?=$quantity?>
                        <?php else: ?>
                            <?="0"?>
                        <?php endif; ?>
					</span>
                </div>
            </div>
                <div class="fas fa-bars" id="menu_btn"></div>
            </div>
        <?php endif; ?>
        <form class="searchForm" action="/search" method="post">
            <input type="search" name="search" id="search-box" placeholder="Поиск по сайту" />
            <button type="submit"><i class="fas fa-search"></i></button>
        </form>

        <?= $cart ?>
    </div>
</div>

<!-- *header section end -->
