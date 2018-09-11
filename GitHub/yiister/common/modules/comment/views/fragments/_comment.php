<?php

/* @var $commentAuthor common\modules\user\models\User */
/* @var $post \common\modules\post\models\Post */

use yii\helpers\Html;

/* Init */
$userImage   = $model->post->user->image_id;
$postId      = $model->post->id;
$authorsName = $model->user->username
        
?>

<?php if ($ghostMode) : ?>
    <div style="display:none"></div>
    
<?php return; endif; ?>

<div id="commentMain_<?= $model->id ?>" class="comments-main">
    <div class="col-md-2 cmts-main-left">
        
        <?php if ($userImage) : ?>
            <img src="/images/avatar.png" alt="">
        <?php else : ?>
            <img src="/images/avatar.png" alt="">
        <?php endif; ?>
            
    </div>
    <div class="col-md-10 cmts-main-right">

        <?php if ($moderation) : ?>
        <div class="dropdown pull-right">
            <button class="dropbtn glyphicon glyphicon-option-vertical dropdown-toggle pull-right moderateOptions"></button>
            <div id="myDropdown" class="dropdown-content">
               <ul class="moderateDropdopUl">
               <li>
                      <span id="<?= $model->id ?>" class="moderateToggle">
                        Szerkesztés
                      </span>
                </li>
               <li>
                    <span id="<?= $model->id ?>" class="deleteComment">
                        Törlés
                    </span>
                </li>
                </ul>
            </div>
        </div>

            <div id="modTextarea_<?= $model->id ?>" class="modTextarea">
                <?= Html::beginForm(['/post/view','id' => $postId,], 'post', ['data-pjax' => '', 'class' => 'form-inline']) ?>
                    <?= Html::hiddenInput('commentId', $model->id) ?>
                    <?= Html::textarea('text', '', ['id' => 'textarea_' . $model->id]) ?>
                    <span id="save_<?= $model->id ?>" class="btn btn-success">Mentés</span>
                    <span id="cancel_<?= $model->id ?>" class="btn btn-default">Mégsem</span>
                <?= Html::endForm() ?>
            </div>
        <?php endif; ?>

        <p id="username_<?= $model->id ?>">
            <?= $authorsName ?>
        </p>
        <h5 id="h5_<?= $model->id ?>"><?= $model->text ?></h5>
        <h4 id="modTag_<?= $model->id ?>" class="moderatedTag">
            
            <?php if ($model->moderated == 1) : ?>
               --Szerkesztve--
            <?php endif; ?>
               
        </h4>
        <div class="cmts">
            <div class="cmnts-left" id="date_<?= $model->id ?>">
                <p><?= date('M d h:m', strtotime($model->created_at)) ?></p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>