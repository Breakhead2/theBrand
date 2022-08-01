<?php
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
define('TEMPLATES_DIR', ROOT . '/templates/');
define('IMAGES', ROOT . '/images/');
define('PROFILE_IMG', ROOT . '/images/users/');

//параметры подкл к БД
define('HOST', 'localhost:3306');
define('USER', 'denis_s');
define('PASS', 'Fib0naccI12358');
define('DB_NAME', 'the_brand');

//подключение модулей
require "./engine/db.php";
require "./engine/router.php";
require "./engine/restApi.php";
require "./engine/auth.php";
require "./engine/render.php";
require "./models/catalog.php";
require "./models/cart.php";
require "./models/offers.php";
require "./models/users.php";
require "./models/subscribers.php";
require "./models/profile.php";
require "./models/colorsAndSizes.php";
require "./models/reviews.php";
