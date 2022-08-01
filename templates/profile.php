<section class="profile">
    <div class="profile__container">
        <div class="photo">
            <div class="photo_container">
                <img src="/images/users/<?=$_SESSION['user']?>/<?=$user['profile_photo']?>" alt="profile_photo">
            </div>
            <div class="tools">
                    <a href="/profileEdit/<?=$_SESSION['user']?>" class="edit">Редактировать профиль</a>
            </div>
        </div>
        <div class="about">
            <h2><?=$user['name'] . " " . $user['surname']?></h2>
            <ul class="profile_info">
                <li>
                    <p class="profile_info_row">Страна: <span id="country"><?=$user['country']?></span></p>
                </li>
                <li>
                    <p class="profile_info_row">Город: <span id="city"><?=$user['city']?></span></p>
                </li>
                <li>
                    <p class="profile_info_row">Почтовый индекс: <span id="postcode"><?=$user['postcode']?></span></p>
                </li>
                <li>
                    <p class="profile_info_row">Телефон: <span id="phone"><?=$user['phone']?></span></p>
                </li>
                <li>
                    <p class="profile_info_row yourself">О себе:</p>
                    <span id="yourself"><?=$user['about']?></span>
                </li>
            </ul>        </div>
    </div>
</section>

<?=$reviewEdit?>

<?=$review?>