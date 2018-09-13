<?php

/* @var $widget \yii\base\Widget */
/* @var $comment \common\modules\comment\models\Comment */
/* @var $commentProvider \yii\data\ActiveDataProvider */

use yii\widgets\ListView;
use richardfan\widget\JSRegister;
use yii\helpers\Url;

/* View init */
$ghostMode = false;

if ($commentProvider->getTotalCount() == 0) {
    $ghostMode = true;
}

?>

<?php JSRegister::begin(['position' => \yii\web\View::POS_BEGIN]); ?>
<script>
    // JS inicializáció
    var addCommentUrl      = "<?= Url::toRoute(['/comment/ajax/addComment'], true) ?>";
    var deleteCommentUrl   = "<?= Url::toRoute(['/comment/ajax/deleteComment'], true) ?>";
    var moderateCommentUrl = "<?= Url::toRoute(['/comment/ajax/moderateComment'], true) ?>";
    var csrfToken          = "<?=Yii::$app->request->getCsrfToken()?>";
    var postId             = "<?= $postId ?>";
</script>
<?php JSRegister::end(); ?>

<?php JSRegister::begin(['position' => \yii\web\View::POS_READY]); ?>
<script>
    // Kezdeti eseményfigyelő hozzáadás
    activateAddFunction();
    activateModerateFunction();
    activateDeleteFunction();
</script>
<?php JSRegister::end(); ?>

<?= $widget->render("@common/modules/comment/views/partial/writeComment", ['postId' => $postId]) ?>

<div id='commentListWidget'>
    <?= ListView::widget([
        'dataProvider'   => $commentProvider,
        'itemView'       => '@common/modules/comment/views/fragments/_comment',
        'emptyText'      => '',
        'viewParams'     => [
            'moderation' => $moderation,
            'ghostMode'  => $ghostMode
        ],
        'summary'      => '',
    ]) ?>
</div>
<?php if ($commentProvider->getTotalCount() == 0) :?>
    <?= $widget->render("@common/modules/comment/views/partial/noComments") ?>
<?php endif; ?>
