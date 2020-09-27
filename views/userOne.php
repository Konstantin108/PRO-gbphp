<?php
/** @var \app\models\User $user */
?>

<h2><?= $user->login ?></h2>
<h3 class="red_text"><?= $user->name ?></h3>
<h3 class="blue_text"><?= $user->position ?></h3>
<?php switch ($user->is_admin): ?><?php case 1: ?>
        <h3 style="color: red">данный пользователь является администратором</h3>
    <?php break; ?>
    <?php case 2: ?>
        <h3 style="color: red">данный пользователь имеет расширенные права</h3>
        <a href="?p=user&a=updateUser&id=<?= $user->id ?>">Редактировать</a>
        <a href="?c=user&a=delUser&id=<?= $user->id ?>" class="del">удалить пользователя</a><br><br>
    <?php break; ?>
    <?php case 3: ?>
        <a href="?p=user&a=updateUser&id=<?= $user->id ?>">Редактировать</a>
        <a href="?c=user&a=delUser&id=<?= $user->id ?>" class="del">удалить пользователя</a><br><br>
    <?php break; ?>
<?php endswitch ?>
<a href="?c=user&a=all">назад</a>
<hr>
