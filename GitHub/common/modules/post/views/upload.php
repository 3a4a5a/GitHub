<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use dosamigos\ckeditor\CKEditor;
use richardfan\widget\JSRegister;

use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $upload common\modules\post\models\Post */
/* @var $uploadPostForm yii\widgets\ActiveForm */

$this->title = 'Bejegyzés írása';
?>
<div class="row">
    <div class="col-md-8">
        <div class="post-create">
            <h2 class="trumpinusTitle">Bejegyzés írása</h2>
            <br>
            <div class="post-form">    
                <?php $form = ActiveForm::begin([
                    'id' => 'upload-post-form',
                    'validateOnType' => true,
                    'enableClientValidation' => false,
                    'enableAjaxValidation' => true,
                ]); ?>
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
    <div class="col-md-4 post-tools">
        <ul class="list-group">
            <li class="list-group-item list-title">
                <span class="glyphicon glyphicon-tasks"></span> 
                Eszközök
            </li>
            <li class="list-group-item"><span onclick="fillWithDummy();">Kitöltés dummy adatokkal</span></li>
            <li class="list-group-item"><span onclick="resetPost();">Újrakezdés</span></li>
          </ul>
    </div>
</div>

<?php JSRegister::begin([
    'key' => 'bootstrap-modal',
    'position' => \yii\web\View::POS_BEGIN
]); ?>
<script>
    var shortDummy  = `<?= Yii::$app->params['dummyText']['shortDummy'] ?>`;
    var mediumDummy = `<?= Yii::$app->params['dummyText']['mediumDummy'] ?>`;
    var hugeDummy   = `<?= Yii::$app->params['dummyText']['hugeDummy'] ?>`;
    
    /**
     * Kitölti a formot sablon adatokkal
     * @returns {undefined}
     */
    function fillWithDummy()
    {
        // Cím
        $("#uploadpostform-title").val(shortDummy);
        
        // Leírás
        $("#uploadpostform-lead").val(mediumDummy);
        
        // Szöveg
        $("#cke_1_contents iframe").contents().find("p").html(hugeDummy);
        
        // Dátum
        $("#uploadpostform-publish_date").val("2018-09-02");
    };

    /**
     * Kitörli a formban lévő inputok értékét
     * @returns {undefined}
     */
    function resetPost()
    {
        // Inputok kiürítése
        $("#upload-post-form").find("input[type=text]").val("");

        // CKEditor kiürítése (alapértelmezett érték <br> oldalbetöltésnél)
        $("#cke_1_contents iframe").contents().find("p").html("<br>");

        // Status resettelése
        $("#uploadpostform-status option").first().attr('selected','selected');

        // Kommentálható resettelése
        $("#uploadpostform-commentable option").first().attr('selected','selected');

        // Fájl resettelése
        $("#uploadpostform-_image").val("");

        // Címkék eltávolítása
        deleteSelect2Content();
    };

    /**
     * Üríti a select2-ben lévő elemeket a törlés ikonra való kattintással.
     * Az összes elemet törli.
     * @returns {undefined}
     */
    function deleteSelect2Content()
    {
        $(".select2-selection__choice__remove").click();

        // Ameddig létezik ilyen elem (ameddig van elemet a select2-ben)
        if ($(".select2-selection__choice__remove").length > 0) {
            setTimeout(deleteSelect2Content, 10);
        }
    };
</script>
<?php JSRegister::end(); ?>