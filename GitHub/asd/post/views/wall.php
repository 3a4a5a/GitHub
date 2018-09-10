<?php

/* @var $postProvider yii\data\ActiveDataProvider */
/* @var $mode string */
/* @var $comments common\modules\comment\models\Comment */

use yii\helpers\Url;
use common\modules\post\widget\RecentPosts\RecentPosts;
use common\modules\post\widget\PostList\PostList;
use common\modules\comment\widget\RecentComments\RecentComments;

?>

<div class="row">
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-12">
                <h2 class="trumpinusTitle">Üzenőfal</h2>
                    
                    <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->getFollowerCount() > 0) : ?>

                    <div class="dropdown trumpButton mainPageDropDown" style="float:left">
                        <span style="color:#fff;">

                            <?php if ($data['show'] == 'all') : ?>
                                Mind
                            <?php else: ?>
                                Követett
                            <?php endif; ?>

                            <span class="caret"></span>
                        </span>
                        <div style="color:#000;" class="dropdown-content showingMode">

                            <?php if ($data['show'] == 'all') : ?>
                                <li><a href="<?= Url::toRoute(['/post/wall', 'mode' => 'followed'], true); ?>">Követett</a></li>
                            <?php else: ?>
                                <li><a href="<?= Url::toRoute(['/post/wall', 'mode' => 'all'], true); ?>">Mind</a></li>
                            <?php endif; ?>

                        </div>
                    </div>

                    <?php endif; ?>
                
                <div class="search2" style="float:left">
                    <input id="searchPosts" type="text" placeholder="Keresés..." autocomplete="off">
                </div>
                
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                
                <?= PostList::widget([
                    'mode' => 'active'
                ]) ?>
                
            </div>
        </div>
    </div>
    <div id="rightPanel" class="col-md-3 integ">
        <div class="l_g_r">
            <div class="posts">
                <h4>Legfrissebb bejegyzések</h4>
                 
                <?= RecentPosts::widget() ?>

            </div>
            <div class="comments">
                <h4>Legutóbbi hozzászólások</h4>

                <?= RecentComments::widget() ?>

            </div>
            <div class="categories">
                <h4>Kategóriák</h4>

                

            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>