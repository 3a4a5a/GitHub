<?php

use yii\widgets\ListView;

?>

<div class="recentPosts">
    <h4>Legfrissebb bejegyzések</h4>
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'summary'      => '',
        'itemView'     => '../fragments/_recentPost',
    ]) ?>
</div>