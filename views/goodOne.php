<?php
/** @var \app\models\Good $good */
?>

<h2><?= $good->name ?></h2>
<h3><?= $good->price ?>р.</h3>
<h4>Информация о товаре</h4>
<h3><?= $good->info ?></h3>
<a href="?c=good&a=updateGood&id=<?= $good->id ?>">Редактировать</a>
<a href="?c=good&a=delGood&id=<?= $good->id ?>" class="del">удалить товар</a><br><br>
<a href="?c=good&a=all">назад</a>
<hr>
