<?php

/* @var $model common\modules\post\models\Post */

use yii\helpers\Url;
use yii\helpers\Html;
use richardfan\widget\JSRegister;


/* Init */
$linkToUserProfile = Url::toRoute(['/user/profile/view', 'id' => $model->user->id], true);
$postId     = $model->id;
$title      = $model->title;
$authorId   = $model->user_id;
$linkToPost = Url::toRoute(['/post/view', 'id' => $model->id], true);
$image      = base64_decode($model->content);
$postedAt   = Yii::$app->formatter->format($model->created_at, 'relativeTime');
$username   = $model->user->username;
$imageId    = $model->image_id;
$load       = $model->lead;
$image      = base64_decode($model->content);
?>

<div class="col-md-4">
    <div class="dapibus">
        <h2 class="postTitle"><?= $title ?></h2>
        
        <?php if (Yii::$app->user->id == $authorId) : ?>
            <?= Html::beginForm('','post',['id' => 'remove' . $postId]) ?>
            <span style="cursor:pointer;" onclick="remove(<?= $postId ?>)" class="glyphicon glyphicon-remove pull-right postDeleteButton"></span>
                <?= Html::hiddenInput('postId', $postId) ?>
            <?= Html::endForm() ?>
        <?php endif; ?>
        
        <p class="adm">Szerző:
            <a href="<?= $linkToUserProfile ?>">
                <?= $username ?></a> |
            <?= $postedAt ?>
        </p>

        <?php if ($imageId != null) : ?>
            <a href="<?= $linkToPost ?>">
                 <img src="data:image/png;base64,<?= $image ?>" class="img-responsive" alt=""/>
            </a>
        <?php endif;?>

        <p class="postLead">
            <?= $load ?>
        </p>
        <br>
        <span class="readMore center-block">
            <span class="glyphicon glyphicon-triangle-right"></span>
            <a href="<?= $linkToPost ?>" class="link">Részletek</a>
        <span>
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