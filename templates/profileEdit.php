<section class="profile">
    <form id="formProfile" action="/edit" method="post" novalidate enctype="multipart/form-data" class="profile__container">
        <div class="photo">
            <div class="photo_container">
                <img src="/images/users/<?=$_SESSION['user']?>/<?=$user['profile_photo']?>" alt="profile_photo">
            </div>
            <div class="tools">
                <input type="file" class="file" name="profile_photo">
                <span><?=$_SESSION['error']?></span>
            </div>
        </div>
        <div class="about">
            <h2><?=$user['name'] . " " . $user['surname']?></h2>
            <ul class="profile_info">
                <li>
                    <p class="profile_info_row">Страна:</p>
                    <label for="country">
                        <input type="text" id="country" data-valid="check" name="country" placeholder="Страна" value="<?=$user['country']?>">
                        <span class="error"></span>
                    </label>
                </li>
                <li>
                    <p class="profile_info_row">Город:</p>
                    <label for="city">
                        <input type="text" id="city" data-valid="check" name="city" placeholder="Город" value="<?=$user['city']?>">
                        <span class="error"></span>
                    </label>
                </li>
                <li>
                    <p class="profile_info_row">Почтовый индекс:</p>
                    <label for="postcode">
                        <input type="text" id="postcode" data-valid="check" maxlength="6" name="postcode" placeholder="Почтовый индекс" value="<?=$user['postcode']?>">
                        <span class="error"></span>
                    </label>
                </li>
                <li>
                    <p class="profile_info_row">Телефон:</p>
                    <label for="phone">
                        <input type="text" id="phone" data-valid="check"name="phone" placeholder="Телефон" value="<?=$user['phone']?>">
                        <span class="error"></span>
                    </label>
                </li>
                <li>
                    <p class="profile_info_row yourself">О себе:</p>
                    <label for="about_yourself" id="about_yourself">
                        <textarea name="about" id="about" placeholder="О себе"><?=$user['about']?></textarea>
                    </label>
                </li>
            </ul>
            <button id="save" type="submit">Сохранить</button>
        </div>
    </form>
</section>

<?=$review?>