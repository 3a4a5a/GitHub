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
                    'disabled' => 'true',
                    ]) ?>
            <?php ActiveForm::end() ?>
            
    </div>
</div>

<?php
/*********************************************
 * UI funkció függvények (keyupok, fadek stb.)
 *********************************************/
JSRegister::begin([
    'position' => \yii\web\View::POS_READY
]); ?>
<script>
   /* Keyupos quick-validáció. */
   
   // Felhasználónév
   var originalUsername = "<?= Yii::$app->user->identity->username ?>";
   var emailTrigger = false;
   var usernameTrigger = false;
   
    $("#usernameInput").keyup(function() {
       if ($("#usernameInput").val().length === 0 || $("#usernameInput").val() === originalUsername) {
           usernameTrigger = false;
           if (emailTrigger === false) {
               $("#submitButton").prop("disabled", true);
           }
       } else {
           usernameTrigger = true;
           $("#submitButton").prop("disabled", false);
       }
    });
    
    // Email
   var originalEmail = "<?= Yii::$app->user->identity->email ?>";
   
    $("#email").keyup(function() {
       if ($("#email").val().length === 0 || $("#email").val() === originalEmail) {
           emailTrigger = false;
           if (usernameTrigger === false) {
               $("#submitButton").prop("disabled", true);
           }
       } else {
           emailTrigger = true;
           $("#submitButton").prop("disabled", false);
       }
    });
</script>
<?php JSRegister::end(); ?>