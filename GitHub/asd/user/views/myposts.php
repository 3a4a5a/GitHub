<?php

/* @var $postProvider common\modules\post\models\Post */

use yii\bootstrap\Tabs;

?>
<div class="col-md-9">
<h2 style="color:#565656;">Saját bejegyzéseim</h2>
<?php
    echo Tabs::widget([
    'items' => [
        [
            'label' => 'Aktív',
            'content' => $this->render('sections/active', [
                'dataProvider' => $activePostProvider,
            ]),
            'active' => true
        ],
        [
            'label' => 'Piszkozat',
            'content' => $this->render('sections/active', [
                'dataProvider' => $inactivePostProvider,
            ]),
            'headerOptions' => [],
            'options' => ['id' => 'myveryownID'],
        ],
    ],
]);
?>
</div>
<div class="col-md-3 rpanel">
    <div class="row rpanel">
        <ul id="recentPosts">
            <li>Lorem</li>
            <li>Lorem</li>
            <li>Lorem</li>
            <li>Lorem</li>
            <li>Lorem</li>
            <li>Lorem</li>
        </ul>
    </div>
    <div class="row rpanel">
        <ul id="recentPosts">
            <li>Lorem</li>
            <li>Lorem</li>
            <li>Lorem</li>
            <li>Lorem</li>
            <li>Lorem</li>
            <li>Lorem</li>
        </ul>
    </div>
</div>