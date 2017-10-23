<?php

use \app\widgets\ShamanProxyUserWidget;

/* @var $this yii\web\View */
$this->title = 'Пользователь';
?>

<div class="row">
    <?= ShamanProxyUserWidget::widget(['user' => $user]); ?>
</div>