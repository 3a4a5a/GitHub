<?php

use yii\helpers\Html;
use richardfan\widget\JSRegister;
use yii\widgets\Pjax;
use yii\helpers\Url;

?>
<div class="col-md-9">
    <h2 class="trumpinusTitle">Címkék</h2>

<?php Pjax::begin([
    'id' => 'labelListSelection',
    'timeout' => 4000,
]) ?>
    <?= Html::beginForm(Url::toRoute(['/label/view'], true), 'post', [
        'id' => 'labelForm',
        'data-pjax' => '',
    ]) ?>
        
        <?php /* @var $label common\modules\label\models\Label */ ?>
        <?php foreach ($labels as $label) : ?>
            <span id="<?= $label->id ?>" class="btn btn-default labelListElement">
                <?php if (in_array($label->name, $selectedLabels)) : ?>
                    <?= Html::checkbox('labels['. $label->name .']', true, [
                        
                    ])?>
                <?php else : ?>
                    <?= Html::checkbox('labels['. $label->name .']', false, [
                        
                    ])?>
                <?php endif; ?>
                <?= $label->name ?>
            </span>
        <?php endforeach; ?>
    <?= Html::endForm() ?>

    <br>
    
    <?php if (count($posts) != 0 && $posts[0] instanceof common\modules\post\models\Post) : ?>
        <?php /* @var $post common\modules\post\models\Post */ ?>
        <?php foreach ($posts as $post) : ?>
            <?= $this->render('sections/_post', [
                'model' => $post,
            ]) ?>
        <?php endforeach; ?>
    <?php else : ?>
        <br>
        <?php if (count($selectedLabels) == 0) : ?>
            Válasszon ki címkéket a hozzátartozó bejegyzések mutatásához.
        <?php else : ?>
            Nem tartoznak bejegyzések a kiválasztott címkék alá.
        <?php endif; ?>
    <?php endif; ?>
        

<?php Pjax::end() ?>
            
<div class="modal">Betöltés...</div>

<?php
/**
 * 
 */
JSRegister::begin([
    'position' => \yii\web\View::POS_BEGIN
]); ?>
<script>
    window.preventLoadingAnim = false;
    
    var preventLoadAnim = function ()
    {
        window.preventLoadingAnim = true;
    };
</script>
<?php JSRegister::end(); ?>

<?php
/**
 * 
 */
JSRegister::begin([
    'position' => \yii\web\View::POS_READY
]); ?>
<script>
    // Töltés animáció ajax eventekre ráállítva.
    $body = $("body");
    $(document).on({
        ajaxStart: function()
        {
            if (window.preventLoadingAnim === false) {
                $body.addClass("loading");
            }
        },
        ajaxStop: function()
        {
            if (window.preventLoadingAnim === false) {
                $body.removeClass("loading");
            }
        }  
    });
    
    var setupListeners = function ()
    {
        $(".labelListElement").off("click");
        $(".labelListElement").click(function(event)
        {
            var id = event.target.id;
            $("span#" + id).find("input").prop('checked', true);
            $("#labelForm").submit();
        });
    };
    
    setupListeners(); // Első oldalbetöltéskor meg kell hívni egyszer.
    
    $(document).on('pjax:success', function()
    {
        // A click listener újra bindolása (?). Lehet, hogy van jobb mód erre. Egyelőre így.
        setupListeners();
    });
</script>
<?php JSRegister::end(); ?>