<?php

use yii\widgets\ListView;

?>

<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView'     => '../fragments/_topFivePost',
    'summary'      => '',
]) ?>