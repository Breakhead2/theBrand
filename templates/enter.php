<section>
    <form action="/login" method="post" class="login_form" novalidate>
        <label for="email">
            Email
            <input
                    data-valid="check"
                    autocomplete="email"
                    type="email"
                    name="email"
                    placeholder="Email"
                    id="email"
                    required
            />
            <span class="error"></span>
        </label>
        <label for="password">
            Пароль
            <input
                    data-valid="check"
                    autocomplete="password"
                    type="password"
                    name="password"
                    placeholder="Пароль"
                    id="password"
                    required
            />
            <?php if($_SESSION['error']) : ?>
                <span class="error active"><?=$_SESSION['error']?></span>
            <?php else: ?>
                <span class="error"></span>
            <?php endif; ?>
        </label>
        <label id="save" for="save">
            <input type="checkbox" name="remember"> Запомнить меня
        </label>
        <button id="formSubmit" type="submit">
            Войти<i class="fas fa-arrow-right"></i>
        </button>
        <p>У вас нет аккаунта? Тогда вам <a class="link" style="color:#F16D7F; font-weight: bold" href="/registration">сюда</a></p>
    </form>
</section>


<?=$review?>