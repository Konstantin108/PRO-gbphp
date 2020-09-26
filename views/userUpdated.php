<?php
/** @var \app\models\User $user */
/** @var \app\models\User[] $users */
?>
<div class="info_block">
    <a href="?c=user&a=all" class="back">
        <i class="fas fa-arrow-left"></i>
        <p class="back_text">назад</p>
    </a>
    <?php if (empty($_POST['idForUpdate'])) : ?>
        <h2 class="info_text">Пользователь успешно добавлен</h2>
    <?php else : ?>
        <h2 class="info_text">Данные успешно обновлены</h2>
    <?php endIf; ?>
</div>