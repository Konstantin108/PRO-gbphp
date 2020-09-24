<?php
/** @var \app\models\User $user */
/** @var \app\models\User[] $users */
?>
<?php if (!$user->id)  : ?>
    <h1 style="color: blue">Создание нового пользователя</h1>
<?php else : ?>
    <h1 style="color: blue">редактирование пользователя <span><?= $user->login ?></span></h1>
<?php endIf; ?>
		<form method="post" action="?c=user&a=getUpdateUser">
		    <input name="idForUpdate" value="<?= $user->id ?>" type="hidden">
			<input name="loginForUpdate" placeholder="<?= $user->login ?>">
			<input name="nameForUpdate" placeholder="<?= $user->name ?>"><br><br>
			<input name="passwordForUpdate" placeholder="<?= $user->password ?>">
			<input name="positionForUpdate" placeholder="<?= $user->position ?>"><br><br>
			<?php if (!$user->id)  : ?>
			    <input type="submit" value="добавить" style="cursor: pointer"><br><br>
			<?php else : ?>
			    <input type="submit" value="отредактировать" style="cursor: pointer"><br><br>
			<?php endIf; ?>
			<?php if (!$user->id)  : ?>
			    <a href="?c=user&a=all">назад</a>
			<?php else : ?>
			    <a href="?c=user&a=one&id=<?= $user->id ?>">назад</a>
			<?php endIf; ?>
		</form>