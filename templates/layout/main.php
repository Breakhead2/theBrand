<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- font awesome link -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
    />
    <!-- custom css file link -->
    <link rel="stylesheet" href="/css/style.css" />
    <link rel="stylesheet" href="/css/<?=$style?>.css" />

    <!-- custom icon link -->
    <link rel="shortcut icon" href="/images/icon.png" type="image/x-icon" />

    <!-- custom js file link -->
    <script type="module" src="/js/main.js" defer></script>

    <title><?=$title?></title>
</head>

<body>
    <div class="wrapper">
        <?=$header?>
        <main class='page'>
            <?=$content?>
        </main>
        <?=$footer?>
    </div>
	
	<?php if($js === 'cart' || $js === 'profile'): ?>
		<script type="module" src="/js/<?=$js?>.js" defer></script>
        <script src ="/js/modules/inputmask.min.js"></script>
    <?php elseif($js) :?>
        <script type="module" src="/js/<?=$js?>.js" defer></script>
	<?php endif ?>
</body>

</html>