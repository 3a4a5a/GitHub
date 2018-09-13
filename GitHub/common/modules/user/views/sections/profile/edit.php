<?php

/* @var $user \common\modules\user\models\User */

use yii\helpers\Html;
use richardfan\widget\JSRegister;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

?>

<div class="row">
    <div class="col-lg-5">
        <h2 class="trumpinusTitle">Adatok szerkesztése</h2>

            <?php $form = ActiveForm::begin([
                'enableClientValidation' => 'false',
                'enableAjaxValidation' => 'true',
            ]) ?>
                <?= $form->field($model, 'email')->textInput(['id' => 'usernameInput'])->hint('Enter a new email')->label('Email') ?>
                <?= $form->field($model, 'username')->textInput(['id' => 'emailInput'])->hint('Enter a new username')->label('Felhasználónév') ?>
                <?= Html::submitButton('Change', [
                    'class'    => 'btn btn-primary', 'id' => 'submitButton',
                    ]) ?>
            <?php ActiveForm::end() ?>
            
    </div>
</div>