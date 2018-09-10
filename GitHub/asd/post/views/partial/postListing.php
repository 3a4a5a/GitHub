<?php

use yii\widgets\ListView;

?>

<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'summary'      => '',
    'itemView'     => '../fragments/_post',
]) ?>