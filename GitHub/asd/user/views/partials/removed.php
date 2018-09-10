<?php

?>

<?= yii\widgets\ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_removed',
    'layout' => "{summary}\n{items}\n<div style=\"clear:both\"align='center'>{pager}</div>",
    'summary' => '',
]) ?>