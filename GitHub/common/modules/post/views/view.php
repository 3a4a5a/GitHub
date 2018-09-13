<?php

/* @var $post common\modules\post\models\Post */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use richardfan\widget\JSRegister;
use \common\modules\comment\widget\CommentList\CommentList;

/* View init */
$postAuthorsUsername = $post->user->username;
$authorRegisteredAt  = date('Y.m.d', strtotime($post->created_at));
$publishDate         = date('Y.m.d', strtotime($post->publish_date));
$moderatable         = Yii::$app->user->id == $post->user_id ? true : false;
$userLoggedIn        = Yii::$app->user->isGuest ? true : false;

?>
<div class="details">
    <div class="container">
        <div class="det_pic">
            <div class="det_text">
                
                <h2><?= $post->title ?></h2>
                
                <?php if ($moderatable) : ?>
                <div style="margin-bottom: 40px;">
                    <a href="<?= Url::toRoute(['/post/edit', 'id' => $post->id], true); ?>">
                        <button class="btn btn-primary">
                            Szerkesztés
                        </button>
                    </a>
                </div>
                <?php endif; ?>
                
                <?= $post->lead ?>
            </div>
            
            <img src="/images/szeles.jpg" class="img-responsive" alt="">
        </div>
        <div class="det_text">
            <?= $post->text ?>
        </div>
    </div>
</div>

<div class="row">
    <h4 style="color:#777;">A szerzőről:</h4>
    <div class="col-md-4" id="authorBox">
        <div class="col-md-4">
            <img src="/images/avatar.png" alt="<?= $postAuthorsUsername ?>" style="width:96px">
        </div>
        <div class="col-md-8 authorDetails">
            <ul class="authorDetails">
                <li>
                    Felhasználónév:   
                    <b> 
                       <a href="
                            <?= Url::toRoute(['/user/profile/view', 'id' => $post->user->id], true) ?>
                        ">
                        <?= $postAuthorsUsername ?>  
                        </a>
                    </b>
                </li>
                <li>Email: <b> <?= $post->user->email ?></b></li>
                <li>Reg. ideje: <b> <?= $authorRegisteredAt ?></b></li>
                <li>Cikkek száma: <b> <?= count($post->user->posts) ?></b> </li>
            </ul>
        </div>
    </div>
</div>

<ul class="links">
    <li>
        <span class="icon_text">
            <span class="glyphicon glyphicon-tags"></span>
            <span> Címkék: </span>
            
            <?php if (count($post->labels) != 0) : ?>
                <?php foreach ($post->labels as $label) : ?>
                    <a href="<?= Url::toRoute(['/label/view', 'name' => $label->name], true) ?>"><?= $label->name . ', ' ?></a>
                <?php endforeach; ?>
            <?php else : ?>
                Nincsenek címkék.
            <?php endif; ?>
                
        </span>
    </li>
</ul>
<ul class="links_middle">
    <li>
        <span class="icon_text">
            <span class="glyphicon glyphicon-calendar"></span>
            Publikálás dátuma: <i class="date"><?= $publishDate ?></i>
        </span>
    </li>
</ul>
<ul class="links_middle">
    <li>
        <span class="icon_text">
            <span class="glyphicon glyphicon-eye-open"></span>
             Megtekintések:
             
            <?= $post->hits_count ?>
             
        </span>
    </li>
</ul>
   <ul class="links_bottom">
   <li>
        <span class="icon_text">
            <span class="glyphicon glyphicon-comment"></span>
            
            <?= count($comments) . ' komment' ?>
            
        </span>
   </li>
</ul>

<?= CommentList::widget(['postId' => $post->id, 'moderation' => $moderatable]) ?>

</div>