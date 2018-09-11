<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Yiister | Settings';
$this->params['breadcrumbs'][] = 'Settings';
   
?>

<div class="row">
    <div class="col-md-6">
       
       <h3>General</h3>
       
        <?php $form = ActiveForm::begin([
            'enableClientValidation' => 'false',
            'enableAjaxValidation' => 'true', ])?>

            <?= $form->field($generalForm, 'username')->textInput()->hint('Enter a new username')->label('Username') ?>
       
            <?= $form->field($generalForm, 'name')->textInput()->hint('Enter a new display name')->label('Display name') ?>
       
            <?= $form->field($generalForm, 'first_name')->textInput()->hint('Enter your first name')->label('First name') ?>
       
            <?= $form->field($generalForm, 'last_name')->textInput()->hint('Enter your last name')->label('Last name') ?>
       
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
       
       <h3>Change password</h3>
            
       <?php ActiveForm::end() ?>
            
        <?php $form = ActiveForm::begin([
            'enableClientValidation' => 'false',
            'enableAjaxValidation' => 'true', ])?>

            <?= $form->field($passwordForm, 'old_password')->passwordInput()->hint('Enter your old password')->label('Old password') ?>
       
            <?= $form->field($passwordForm, 'new_password')->passwordInput()->hint('Enter a new password')->label('New password') ?>

            <?= $form->field($passwordForm, 'new_password_again')->passwordInput()->hint('Enter new password again')->label('New password again') ?>

            <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>

       <?php ActiveForm::end() ?>
       
       <h3>Change email</h3>
            
            <?php $form = ActiveForm::begin([
                'enableClientValidation' => 'false',
                'enableAjaxValidation' => 'true', ])?>

            <?= $form->field($emailForm, 'new_email')->textInput()->hint('Enter a new email address')->label('New email') ?>

            <?= Html::submitButton('Send verification email', ['class' => 'btn btn-primary']) ?>

       <?php ActiveForm::end() ?>
    </div>
</div>