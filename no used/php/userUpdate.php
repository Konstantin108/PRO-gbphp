<?php
/** @var \app\models\User $user */
/** @var \app\models\User[] $users */
?>
<?php if (!$user->id)  : ?>
    <h1 style="color: blue">Создание нового пользователя</h1>
<?php else : ?>
    <h1 style="color: blue">редактирование пользователя <span><?= $user->login ?></span></h1>
<?php endif; ?>
<form method="post" action="?c=user&a=getUpdateUser">
    <input name="idForUpdate" value="<?= $user->id ?>" type="hidden">
    <input name="loginForUpdate" value="<?= $user->login ?>">
    <input name="nameForUpdate" value="<?= $user->name ?>"><br><br>
    <input name="passwordForUpdate" value="<?= $user->password ?>">
    <input name="positionForUpdate" value="<?= $user->position ?>"><br>
    <p class="adminStat">Расширенные права</p>
    <select name="adminStat" id="adminStat">
        <option value="nothing">Значение не выбрано</option>
        <option value="yes">Да</option>
        <option value="no">Нет</option>
    </select>
    <?php if (!$user->id)  : ?>
        <input type="submit" value="добавить" style="cursor: pointer"><br><br>
    <?php else : ?>
        <input type="submit" value="отредактировать" style="cursor: pointer"><br><br>
    <?php endif; ?>
    <?php if (!$user->id)  : ?>
        <a href="?c=user&a=all">назад</a>
    <?php else : ?>
        <a href="?c=user&a=one&id=<?= $user->id ?>">назад</a>
    <?php endif; ?>
</form>