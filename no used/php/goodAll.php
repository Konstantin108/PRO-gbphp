<?php
/** @var \app\models\Good[] $goods */
?>
    <a href="?c=good&a=updateGood&id=<?= $good->id ?>">Добавить новый товар</a>
<?php foreach ($goods as $good) : ?>
    <h2><?= $good->name ?></h2>
    <h3><?= $good->price ?>р.</h3>
    <a href="?c=good&a=one&id=<?= $good->id ?>">подробнее</a>
    <hr>
<?php endforeach; ?>