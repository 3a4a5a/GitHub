<?php

use common\modules\post\widget\PostList\PostList;
use common\modules\post\widget\RecentPosts\RecentPosts;
use common\modules\comment\widget\RecentComments\RecentComments;

/* @var $data array */

?>

<div class="row">
    <div class="col-md-9">
        <h2 class="trumpinusTitle">Üzenőfal</h2>
        <?= PostList::widget([
            'mode' => 'active'
        ]) ?>
    </div>
    <div class="col-md-3">
        <?= RecentPosts::widget() ?>
        <?= RecentComments::widget() ?>
    </div>
</div>