<?php
/** @var \app\models\User $user */
/** @var \app\models\User[] $users */
?>
<form method="post" class="del_block" action="?c=user&a=getDelUser">
    <a href="?c=user&a=one&id=<?= $user->id ?>" class="back">
        <i class="fas fa-arrow-left"></i>
        <p class="back_text">назад</p>
    </a>
    <input name="idForDel" value="<?= $user->id ?>" type="hidden">
    <p class="del_text">Удалить пользователя?</p>
    <p class="alarm_text">Восстановить данные будет невозможно</p>
    <div class="btn_block">
        <input type="submit" value="удаление" class="del_group_btn">
        <a href="?c=user&a=one&id=<?= $user->id ?>" class="cancel_group_btn">отмена</a>
    </div>
</form>