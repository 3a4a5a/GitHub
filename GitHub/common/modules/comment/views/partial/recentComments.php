<?php

use yii\widgets\ListView;

/* @var $dataProvider \yii\data\ActiveDataProvider */

?>

<div class="recentComments">
    <h4>Legfrissebb hozzászólások</h4>
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'summary'      => '',
        'itemView'     => '../fragments/_recentComment',
    ]) ?>
</div>