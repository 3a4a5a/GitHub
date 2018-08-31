<?php

/* @var $widget \yii\base\Widget */
/* @var $comment \common\modules\comment\models\Comment */

use yii\widgets\ListView;

?>

<div id='commentListWidget'>   
    <?= ListView::widget([
        'dataProvider' => $commentProvider,
        'itemView' => 'fragment/_comment',
        'summary' => '',
    ]) ?>
</div>
