    <section class="login">
        <div class="login__container">
            <form action="/signup" class="loginForm" method="post" novalidate>
                <div class="loginForm__information">
                    <h4 class="loginForm__information_name">Как вас зовут?</h4>
                    <label for="firstName">
                        <input data-valid="check" type="text" name="firstName" placeholder="Имя" id="firstName" required />
                        <span class="error"></span>
                    </label>
                    <label for="secondName">
                        <input data-valid="check" type="text" name="secondName" placeholder="Фамилия" id="secondName" required />
                        <span class="error"></span>
                    </label>
                </div>
                <div class="loginForm__gender">
                    <label for="gender">
                        <input type="radio" name="gender" value="мужчина" id="male"  checked />Мужчина
                    </label>
                    <label for="gender">
                        <input type="radio" name="gender" value="женщина" id="female" />Женщина
                    </label>
                </div>
                <div class="loginForm__information">
                    <h4 class="loginForm__information_name">Параметры авторизации</h4>
                    <label for="email">
                        <input
                                data-valid="check"
                                autocomplete="email"
                                type="email"
                                name="email"
                                placeholder="Email"
                                id="email"
                        />
                        <span class="error"></span>
                    </label>
                    <label for="password">
                        <input
                                data-valid="check"
                                autocomplete="password"
                                type="password"
                                name="password"
                                placeholder="Пароль"
                                id="password"
                        />
                        <?php if($_SESSION['error']) : ?>
                            <span class="error active"><?=$_SESSION['error']?></span>
                        <?php else: ?>
                            <span class="error"></span>
                        <?php endif; ?>
                    </label>
                </div>
                <button id="formSubmit" type="submit">
                    Зарегестрироваться<i class="fas fa-arrow-right"></i>
                </button>
            </form>
            <div class="loyalty">
                <h3 class="loyalty__heading">Преимущества для наших клиентов:</h3>
                <p class="loyalty__text">
                    Участвуйте в программе лояльности, где вы можете зарабатывать баллы и открывать серьезные привилегии. Начиная с того, как только вы присоединитесь:
                </p>
                <ul class="loyalty__list">
                    <li><i class="fas fa-check"></i>15% скидка</li>
                    <li>
                        <i class="fas fa-check"></i>Бесплатная доставка, возврат и обмен на все заказы
                    </li>
                    <li>
                        <i class="fas fa-check"></i>Скидка 1000&#x20bd на покупки в день рождение
                    </li>
                    <li><i class="fas fa-check"></i>Ранний доступ к продуктам</li>
                    <li><i class="fas fa-check"></i>Эксклюзивные предложения и награды</li>
                </ul>
            </div>
        </div>
    </section>

<?=$review?>
