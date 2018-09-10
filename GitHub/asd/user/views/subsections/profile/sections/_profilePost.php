<?php

/* @var $model common\modules\post\models\Post */

use yii\helpers\Url;
use yii\helpers\Html;
use richardfan\widget\JSRegister;

?>

<div class="col-md-4 praesent">
    <div class="l_g_r">
        <div class="dapibus">
            
            <?php if ($ownProfile) : ?>
                <?= Html::beginForm('','post',['id' => 'remove' . $model->id]) ?>
                <span style="cursor:pointer;" onclick="remove(<?=$model->id?>)" class="glyphicon glyphicon-remove postDeleteButton"></span>
                <?= Html::hiddenInput('postId', $model->id) ?>
                <?= Html::endForm() ?>
            <?php endif; ?>
            
            <h2 class="truncate"><?= $model->title ?></h2>
            <a href="<?= Url::toRoute(['/post/view', 'id' => $model->id], true) ?>">
                <img src="/images/negyzet.jpg" class="img-responsive" alt="">
            </a>
            <p>Phasellus ultrices nulla quis nibh. Quisque a lectus. Donec consectetuer ligula vulputate. </p>
            <a href="details.html" class="link">Read More</a>
            
            <?php if ($model->status == 1) : ?>
                <p class="adm">Publish date <?=date("Y-m-d", strtotime($model->publish_date))?></p>
            <?php endif; ?>
                
            <div>Kommentek (<?=count($model->comments)?>)</div>
        </div>
    </div>
</div>
<?php JSRegister::begin([
    'key' => 'bootstrap-modal',
    'position' => \yii\web\View::POS_READY
]); ?>
<script>
    remove = function (id) {
        var form = document.getElementById("remove" + id);
        var confirmed = confirm("Biztosan törli?");
        if (confirmed) {
            form.submit();
        }
    }
</script>
<?php JSRegister::end(); ?>