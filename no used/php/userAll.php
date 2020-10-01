<?php
/** @var \app\models\User[] $users */
?>
<a href="?p=user&a=updateUser&id=<?= $user->id ?>">Добавить нового пользователя</a>
<?php foreach ($users as $user) :?>
    <h2><?= $user->login ?></h2>
    <h3 class="red_text"><?= $user->name ?></h3>
    <a href="?c=user&a=one&id=<?= $user->id ?>">подробнее</a>
    <?php switch ($user->is_admin): ?><?php case 1: ?>
            <h3 style="color: red">данный пользователь является администратором</h3>
        <?php break; ?>
        <?php case 2: ?>
            <h3 style="color: red">данный пользователь имеет расширенные права</h3>
        <?php break; ?>
        <?php case 0: ?>
        <?php break; ?>
    <?php endswitch ?>
    <hr>
<?php endforeach;?>
