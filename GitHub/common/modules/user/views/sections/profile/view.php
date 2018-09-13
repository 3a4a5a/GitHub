<?php

/* @var $models['user'] \common\modules\user\models\User */

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\helpers\Url;
use yii\bootstrap\Tabs;
use richardfan\widget\JSRegister;
use common\modules\post\widget\PostList\PostList;
use frontend\bundles\UserAsset;

UserAsset::register($this);

?>

<?php if (isset($data['ownProfile'])) : ?>
    <h2 class="trumpinusTitle">Profilom</h2>
<?php else : ?>
    <h2 class="trumpinusTitle"><?= $models['user']->name ?>  profilja</h2>
<?php endif; ?>
    
<div class="row">
    <div class="col-md-12">
        <ul class="list-group">
          <li class="list-group-item">Teljes név: <b><?= $models['user']->view->getFullName()?></b></li>
          <li class="list-group-item">Email cím: <b><?= $models['user']->email ?></b></li>
          <li class="list-group-item">Név: <b><?= $models['user']->username ?></b></li>
          <li class="list-group-item">Regisztráció dátuma:
              <b><?= date('Y M d', strtotime($models['user']->created_at)) ?>
              </b></li>
        </ul>
        
        <?php if (!isset($data['ownProfile'])) : ?>
            <?php if ($data['follows']) : ?>
                <?= Html::beginForm() ?>
                    <?= Html::submitButton('Unkövetés', ['class' => 'btn btn-default trumpButton2']) ?>
                    <?= Html::hiddenInput('userId', $models['user']->id) ?>
                    <?= Html::hiddenInput('action', 'unfollow') ?>
                <?= Html::endForm() ?>
            <?php else : ?>
                <?= Html::beginForm() ?>
                    <?= Html::submitButton('Követés', ['class' => 'btn btn-primary trumpButton']) ?>
                    <?= Html::hiddenInput('userId', $models['user']->id) ?>
                    <?= Html::hiddenInput('action', 'follow') ?>
                <?= Html::endForm() ?>
            <?php endif; ?>
        <?php else: ?>
                <a href="<?= Url::toRoute(['/user/settings/personal'], true) ?>">
                    <button class="btn btn-primary trumpButton">Adatok zerkesztése
                    </button></a>
        <?php endif; ?>
        
    </div>
</div>
    
<?php if (isset($data['ownProfile'])) : ?>
    <div id="dashboard" class="row">
        <div class="col-md-12">
            <ul class="list-group">
              <li class="list-group-item">Dashboard</li>
              <li class="list-group-item">Követők száma: <b><i><?= $models['user']->countFollowers()?></i></b></li>
              <li class="list-group-item">Bekegyzések száma: <b><i><?= $models['user']->countPosts()?></i></b></li>
              <li class="list-group-item">Aktív bejegyzések száma: <b><i><?= $models['user']->countInactivePosts() ?></i></b></li>
              <li class="list-group-item">Piszkozatok száma: <b><i><?= $models['user']->countActivePosts() ?></i></b></li>
              <li class="list-group-item">Összes érkezett komment: <b><i></i></b></li>
            </ul>
        </div>
    </div>
    
    <?php if ($models['user']->countPosts() > 0) : ?>
        <div class="row top5list">
            <div class="col-md-6">
                <ul class="list-group">
                    <li class="list-group-item ">Legnépszerűbb bejegyzések</li>

                    <?php /* @var $post common\modules\post\models\Post */ ?>
                    <?php foreach($models['mostViewedPosts'] as $post) : ?>
                        <li class="list-group-item"> <?= $post->title ?> </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="col-md-6">
                <ul class="list-group">
                    <li class="list-group-item">Leglátogatottabb bejegyzések</li>
                    
                    <?php /* @var $post common\modules\post\models\Post */ ?>
                    <?php foreach($models['mostPopularPosts'] as $post) : ?>
                        <li class="list-group-item"> <?= $post->title ?> </li>
                    <?php endforeach; ?>

                </ul>
            </div>
        </div>
    <?php endif; ?>
    
<?php endif; ?>
    
<h2>Bejegyzések</h2>

<?php if ($models['user']->hasPosts()) : ?>
    <div class="row">
        <div id="tabContainer" class="col-md-12">
            <?= Tabs::widget([
                'items' => [
                    [
                        'active' => true,
                        'label' => 'Aktív',
                        'content' => PostList::widget([
                            'mode' => 'active'
                        ]),
                    ],
                    [
                        'label' => 'Piszkozat',
                        'content' => PostList::widget([
                            'mode' => 'inactive'
                        ]),
                    ],
                    [
                        'label' => 'Törölt',
                        'content' => PostList::widget([
                            'mode' => 'deleted'
                        ]),
                    ],
                ],
            ]); ?>
        </div>
    </div>
<?php else: ?>
    <div class="noPostsYet">Még nincsenek bejegyzések</div>
<?php endif; ?>