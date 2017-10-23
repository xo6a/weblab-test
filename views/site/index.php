<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'Авторизация';
?>

<div class="row">
    <div class="well">
        <?php
        $form = ActiveForm::begin([
            'id' => 'login-form',
        ]);
        echo $form->errorSummary($model, ['header' => 'Произошла ошибка: ', 'class' => 'alert alert-danger']);
        echo $form->field($model, 'email')->textInput(['autofocus' => true]);
        echo $form->field($model, 'password')->passwordInput();
        echo $form->field($model, 'curlname')->textInput();
        ?>
        <div class="form-group">
            <?= Html::submitButton('Вход', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
