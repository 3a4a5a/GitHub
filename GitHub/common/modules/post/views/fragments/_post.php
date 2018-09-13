<?php

/* @var $model common\modules\post\models\Post */

use yii\helpers\Url;

/* Init */
$image = base64_decode($model->content);

?>
<div class="col-md-4">
    <div class="dapibus">
        <h2 class="postTitle"><?= $model->title ?></h2>
        <p class="adm">Szerző:
            <a href="<?= Url::toRoute(['/user/profile/view', 'id' => $model->user->id], true) ?>">
                <?= $model->user->username ?></a> |
            <?= Yii::$app->formatter->format($model->created_at, 'relativeTime') ?>
        </p>

        <?php if ($model->image_id != null) : ?>
            <!--<a href="<?= Url::toRoute(['/post/view', 'id' => $model->id], true) ?>">
                 <img src="data:image/png;base64,<?= base64_decode($model->content) ?>" class="img-responsive" alt=""/>
            </a>-->
        <?php endif;?>

        <p class="postLead">
            <?= $model->lead ?>
        </p>
        <br>
        <span class="readMore center-block">
            <span class="glyphicon glyphicon-triangle-right"></span>
            <a href="<?= Url::toRoute(['/post/view', 'id' => $model->id], true) ?>" class="link">Részletek</a>
        <span>
    </div>
</div>