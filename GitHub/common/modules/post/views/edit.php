<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use dosamigos\ckeditor\CKEditor;
use richardfan\widget\JSRegister;
use yii\helpers\Url;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $upload common\modules\post\models\Post */
/* @var $uploadPostForm yii\widgets\ActiveForm */

$this->title = 'Bejegyzés szerkesztése';

?>
<div class="row">
<div class="col-md-8 col-md-offset-2">
    <div class="post-create">
        <h2 class="trumpinusTitle">Bejegyzés szerkesztése</h2>
        <br>
        <div class="post-form">    
            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($editPost, 'title')->textInput(['maxlength' => true]) ?>
            <?= $form->field($editPost, 'lead')->textInput(['maxlength' => true]) ?>
            <?= $form->field($editPost, 'text')->widget(CKEditor::className(), [
                'options' => ['rows' => 6],
                'preset' => 'basic'
            ]) ?>
            <?= $form->field($editPost, 'status')->dropDownList(['1' => 'Aktív', '0' => 'Inaktív'], ['class' => 'col ddlist']) ?>
            <?= $form->field($editPost, 'commentable')->dropDownList(['1' => 'Igen', '0' => 'Nem'], ['class' => 'col ddlist']) ?>
            <?= $form->field($editPost, 'publish_date')->widget(
                DatePicker::className(), [
                    'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                    'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ]);?>
            
            <?php if ($editPost->image_id != null) : ?>
                <div id="editPostImage">
                    <?= $form->field($editPost, '_image')->fileInput() ?>
                </div>
                <span id="editPostImageButton" class="btn btn-primary">Kép törlése</span>
            <?php else: ?>
                <?= $form->field($editPost, '_image')->fileInput() ?>
            <?php endif; ?>
            
            <?= $form->field($editPost, 'labels')->widget(Select2::classname(), [
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
                
            <?= $form->field($editPost, 'user_id')->hiddenInput(['value' => Yii::$app->user->id])->label(false) ?>
                
            <?php for ($i = 0; $i < count($ownedLabels); $i++) : ?>
                <?= $form->field($editPost, 'ownedLabels[]')->hiddenInput(['value' => $ownedLabels[$i]])->label(false) ?>
            <?php endfor; ?>
                
            <div class="form-group text-center">
                <?= Html::submitButton('Mentés', ['class' => 'btn btn-success']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
    
<?php

JSRegister::begin([
    'position' => \yii\web\View::POS_READY
]); ?>
<script>
    $("#editPostImageButton").click(function()
    {
        $(this).fadeOut('fast', function(){});
        $("#editPostImage").fadeIn('fast', function(){});
        
        $.ajax({
            url: '<?= Url::toRoute(['/post/edit', 'id' => $editPost->post_id], true) ?>',
            type: 'post',
            data: {

                    action : 'deletePostPic',
                    _csrf : '<?=Yii::$app->request->getCsrfToken()?>'
                  },
            success: function (data) {
               
            }
        });
    });
</script>
<?php JSRegister::end(); ?>