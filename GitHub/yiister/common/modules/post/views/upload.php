<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use dosamigos\ckeditor\CKEditor;

use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $upload common\modules\post\models\Post */
/* @var $uploadPostForm yii\widgets\ActiveForm */

$this->title = 'Bejegyzés írása';
?>
<div class="row">
<div class="col-md-8 col-md-offset-2">
    <div class="post-create">
        <h2 class="trumpinusTitle">Bejegyzés írása</h2>
        <br>
        <div class="post-form">    
            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($uploadPostForm, 'title')->textInput(['maxlength' => true]) ?>
            <?= $form->field($uploadPostForm, 'lead')->textInput(['maxlength' => true]) ?>
            <?= $form->field($uploadPostForm, 'text')->widget(CKEditor::className(), [
                'options' => ['rows' => 6],
                'preset' => 'basic'
            ]) ?>
            <?= $form->field($uploadPostForm, 'status')->dropDownList(['1' => 'Aktív', '0' => 'Inaktív'], ['class' => 'col ddlist']) ?>
            <?= $form->field($uploadPostForm, 'commentable')->dropDownList(['1' => 'Igen', '0' => 'Nem'], ['class' => 'col ddlist']) ?>
            <?= $form->field($uploadPostForm, 'publish_date')->widget(
                DatePicker::className(), [
                    'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                    'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ]);?>
            <?= $form->field($uploadPostForm, '_image')->fileInput() ?>
            <?= $form->field($uploadPostForm, 'labels')->widget(Select2::classname(), [
                //'data' => $labels,
                'data' => $labels,
                'language' => 'hu',
                'options' => ['placeholder' => 'Válassz címkéket ...'],
                'pluginOptions' => [
                    'tags' => true,
                    'tokenSeparators' => [',', ' '],
                    'multiple' => true,
                    'allowClear' => true
                ],
            ]); ?>
            <?= $form->field($uploadPostForm, 'user_id')->hiddenInput(['value' => Yii::$app->user->id])->label(false) ?>
            <div class="form-group text-center">
                <?= Html::submitButton('Mentés', ['class' => 'btn btn-primary trumpButton']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>