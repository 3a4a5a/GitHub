<?php

?>

<?= yii\widgets\ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_post',
    'layout' => "{summary}\n{items}\n<div style=\"clear:both\"align='center'>{pager}</div>",
    'viewParams' => [
        'ownProfile' => $ownProfile,
    ],
    'summary' => '',
]) ?>