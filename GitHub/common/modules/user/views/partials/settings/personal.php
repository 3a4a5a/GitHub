<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<h3>Személyes információk</h3>
       
<?php $form = ActiveForm::begin([
    'enableClientValidation' => false,
    'enableAjaxValidation' => true, ])?>

    <?= $form->field($personalForm, 'username')->textInput()->hint('Adj meg egy új felhasználónevet')->label('Felhasználónév') ?>

    <?= $form->field($personalForm, 'name')->textInput()->hint('Adj meg egy új nevet')->label('Megjelenítendő név') ?>

    <?= $form->field($personalForm, 'first_name')->textInput()->hint('Add meg a keresztneved')->label('Keresztnév') ?>

    <?= $form->field($personalForm, 'last_name')->textInput()->hint('Add meg a vezetékneved')->label('Vezetéknév') ?>

    <?= Html::submitButton('Adatok mentése', ['class' => 'btn btn-primary']) ?>

<?php ActiveForm::end() ?>