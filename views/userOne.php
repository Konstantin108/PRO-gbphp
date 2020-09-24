<?php
/** @var \app\models\User $user */
?>

<h2><?= $user->login ?></h2>
<h3 class="red_text"><?= $user->name ?></h3>
<h3 class="blue_text"><?= $user->position ?></h3>
<?php if ($user->is_admin != 1)  : ?>
    <a href="?p=user&a=updateUser&id=<?= $user->id ?>">Редактировать</a>
    <a href="?c=user&a=delUser&id=<?= $user->id ?>" class="del">удалить пользователя</a><br><br>
<?php else : ?>
    <h3 style="color: red">данный пользователь является администратором</h3>
<?php endIf; ?>
<a href="?c=user&a=all">назад</a>
<hr>
