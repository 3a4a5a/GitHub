<?php

/* @var $user \common\modules\user\models\User */

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\helpers\Url;
use yii\bootstrap\Tabs;
use richardfan\widget\JSRegister;
?>

<?php if ($ownProfile) : ?>
    <h2 class="trumpinusTitle">Profilom</h2>
<?php else : ?>
    <h2 class="trumpinusTitle"><?= $user->username ?>  profilja</h2>
<?php endif; ?>
<div class="row">
    <div class="col-md-12">
        <ul class="list-group">
          <li class="list-group-item">Email cím: <b><?= $user->email ?></b></li>
          <li class="list-group-item">Név: <b><?= $user->username ?></b></li>
          <li class="list-group-item">Regisztráció dátuma:
              <b><?= date('Y M d', strtotime($user->created_at)) ?>
              </b></li>
        </ul>
        <?php if (!$ownProfile) : ?>
            <?php if ($follows) : ?>
                <?= Html::beginForm() ?>
                    <?= Html::submitButton('Unkövetés', ['class' => 'btn btn-default trumpButton2']) ?>
                    <?= Html::hiddenInput('userId', $user->id) ?>
                    <?= Html::hiddenInput('action', 'unfollow') ?>
                <?= Html::endForm() ?>
            <?php else : ?>
                <?= Html::beginForm() ?>
                    <?= Html::submitButton('Követés', ['class' => 'btn btn-primary trumpButton']) ?>
                    <?= Html::hiddenInput('userId', $user->id) ?>
                    <?= Html::hiddenInput('action', 'follow') ?>
                <?= Html::endForm() ?>
            <?php endif; ?>
        <?php else: ?>
                <a href="<?= Url::toRoute(['/user/profile/edit'], true) ?>">
                    <button class="btn btn-primary trumpButton">Adatok zerkesztése
                    </button></a>
        <?php endif; ?>
    </div>
</div>
<?php if ($ownProfile) : ?>
    <div id="dashboard" class="row">
        <div class="col-md-10 col-md-offset-1">
            <ul class="list-group">
              <li class="list-group-item">Dashboard</li>
              <li class="list-group-item">Követők száma: <b><i><?= $followCount ?></i></b></li>
              <li class="list-group-item">Aktív bejegyzések száma: <b><i><?= $activePostCount ?></i></b></li>
              <li class="list-group-item">Piszkozatok száma: <b><i><?= $inactivePostCount ?></i></b></li>
              <li class="list-group-item">Összes érkezett komment: <b><i><?= $overallCommentCount ?></i></b></li>
            </ul>
        </div>
    </div>
    <div class="row top5list">
        <div class="col-md-10 col-md-offset-1">
            <div class="col-md-6">
                <ul class="list-group">
                  <li class="list-group-item">Top 5 legnézettebb</li>
                  <?php foreach ($topFiveViewedPosts as $post) : ?>
                    <li class="list-group-item"><?= $post->title ?></li>
                  <?php endforeach; ?>
                </ul>
            </div>
            <div class="col-md-6">
                <ul class="list-group">
                  <li class="list-group-item">Top 5 legaktívabb</li>
                  <?php foreach ($topFiveCommented as $post) : ?>
                    <li class="list-group-item"><?= $post->title ?></li>
                  <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
<?php endif; ?>
<br>
<br>
<h2 style="color:#666">Bejegyzések</h2>
<div class="row" style="margin-top:20px;">
    <div id="tabContainer" class="col-md-12">
        <?php
            echo Tabs::widget([
            'items' => [
                [
                    'active' => true,
                    'label' => 'Aktív',
                    'content' => $this->render('@common/modules/post/views/fragments/standalone/postList', [
                        'postProvider' => $activePostProvider,
                        'ownProfile' => $ownProfile,
                    ]),
                ],
                [
                    'label' => 'Piszkozat',$inactivePostProvider,
                    'content' => $this->render('@common/modules/post/views/fragments/standalone/postList', [
                        'postProvider' => $inactivePostProvider,
                        'ownProfile' => $ownProfile,
                    ]),
                ],
                [
                    'label' => 'Törölt',$removedPostProvider,
                    'content' => $this->render('@common/modules/post/views/fragments/standalone/postList', [
                        'postProvider' => $removedPostProvider,
                        'ownProfile' => $ownProfile,
                    ]),
                ],
            ],
        ]);
        ?>
    </div>
</div>

<?php
/*********************************************************
* FŐBB FUNKCIÓK (KOMMENT SZERKESZTÉS, TÖRLÉS STB...
 * A komment írása nem itt van kezelve, az Pjaxos újratöltés
**********************************************************/
JSRegister::begin([
    'position' => \yii\web\View::POS_READY
]); ?>
<script>
    /*$("#tabContainer").click(function(event) {
        
    });*/
</script>
<?php JSRegister::end(); ?>