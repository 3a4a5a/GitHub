<?php

use yii\widgets\ListView;

?>

<div class="recentComments">
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'summary'      => '',
        'itemView'     => '../fragments/_recentComment',
    ]) ?>
</div>