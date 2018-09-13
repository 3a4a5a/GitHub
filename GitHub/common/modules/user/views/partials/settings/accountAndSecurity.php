<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<h3>Jelszó megváltoztatása</h3>
       
<?php $form = ActiveForm::begin([
    'enableClientValidation' => false,
    'enableAjaxValidation' => true, ])?>

    <?= $form->field($passwordForm, 'old_password')->passwordInput()->hint('Adja meg a régi jelszavát')->label('Régi jelszó') ?>

    <?= $form->field($passwordForm, 'new_password')->passwordInput()->hint('Adjon meg egy új jelszót')->label('Új jelszó') ?>

    <?= $form->field($passwordForm, 'new_password_again')->passwordInput()->hint('Ismételje meg az új jelszót')->label('Új jelszó még egyszer') ?>

    <?= Html::submitButton('Jelszó megváltoztatása', ['class' => 'btn btn-primary']) ?>

<?php ActiveForm::end() ?>