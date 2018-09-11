<?php

use yii\widgets\ListView;

?>

<div class="recentPosts">
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'summary'      => '',
        'itemView'     => '../fragments/_recentPost',
    ]) ?>
</div>