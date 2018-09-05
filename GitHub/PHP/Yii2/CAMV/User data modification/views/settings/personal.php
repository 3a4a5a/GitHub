<?php
   use yii\widgets\ActiveForm;
   use yii\helpers\Html;
?>

<div class="row">
   <div class="col-md-10 col-md-offset-1 actionpanel hideTableInside">
      <div class="row actionpaneltitle">
         <div class="col-md-12">
            <h3>Settings</h3>
         </div>
      </div>
      <div class="row actionbody">
        <div class="row settingsSection">
            <div class="col-md-12">
                <div class="user-settings">  
                  <div class="col-md-6 personal-info">
                        <h3>Personal information</h3>
                        
                        <?php $form = ActiveForm::begin([
                            'enableClientValidation' => 'false',
                            'enableAjaxValidation' => 'true',
                        ]) ?>
                            <?= $form->field($model, 'display_name')->textInput()->hint('Enter a new display name')->label('Display name') ?>
                            <?= $form->field($model, 'username')->textInput()->hint('Enter a new username')->label('Username') ?>
                            <?= Html::submitButton('Change', ['class' => 'btn btn-purple']) ?>
                        <?php ActiveForm::end() ?>
                        
                    </div>
                </div>
            </div>
        </div>
         <div class="row settingsSection">
            <div class="col-md-12">
                <div class="user-settings">  
                  <div class="col-md-6 personal-info">
                        <h3>Change email</h3>
                        <h4>
                           Current email address is:
                           <b><?= Yii::$app->user->identity->email ?></b>
                        </h4>
                        
                        <?php $form = ActiveForm::begin([
                            'enableClientValidation' => 'false',
                            'enableAjaxValidation' => 'true',
                        ]) ?>
                            <?= $form->field($model, 'new_email')->textInput()->hint('Enter a new email address')->label('New email') ?>
                            <?= $form->field($model, 'password')->textInput()->hint('Enter your password')->label('Password') ?>
                            <?= Html::submitButton('Send email', ['class' => 'btn btn-purple']) ?>
                        <?php ActiveForm::end() ?>
                        
                    </div>
                </div>
            </div>
        </div>
   </div>
</div>