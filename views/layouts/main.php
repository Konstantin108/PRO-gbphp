<?php /** @var string $content */?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <script src="https://kit.fontawesome.com/4bd251a57a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<ul>
    <li><a href="?c=user&a=all">Пользователи</a></li>
    <!-- <li><a href="?c=user&a=one">Пользователь</a></li> -->
    <li><a href="?c=good&a=all">Список товаров</a></li>
</ul>
    <?= $content ?>
</body>
</html>