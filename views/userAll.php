<?php
/** @var \app\models\User[] $users */
?>
<a href="?p=user&a=updateUser&id=<?= $user->id ?>">Добавить нового пользователя</a>
<?php foreach ($users as $user) :?>
    <h2><?= $user->login ?></h2>
    <h3 class="red_text"><?= $user->name ?></h3>
    <a href="?c=user&a=one&id=<?= $user->id ?>">подробнее</a>
    <?php if ($user->is_admin != 1)  : ?>
    <?php else : ?>
        <h3 style="color: red">данный пользователь является администратором</h3>
    <?php endIf; ?>
    <hr>
<?php endforeach;?>
