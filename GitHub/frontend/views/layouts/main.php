<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);

?>

<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php echo Yii::$app->request->baseUrl; ?>/images/trump.png" type="image/x-icon" />
    
    <?= Html::csrfMetaTags() ?>
    
    <title><?= Html::encode($this->title) ?></title>
    
    <?php $this->head() ?>
    
</head>
<body>
    
<?php $this->beginBody() ?>
    
<div class="wrap">
<div class="banner">
    <div class="container">
        <div class="header">
            <div class="logo">
                
                <a href="<?= Url::home() ?>">
                    
                    <img id="logoPic" width="100" height="100" src="/images/trump.png" class="img-responsive" alt="" />
                    <div id="logoText">
                        Trumpinus
                        
                        <?php if (!Yii::$app->user->isGuest) : ?>
                            <h5 id="usernameUnderLogo"><?= Yii::$app->user->identity->email ?></h5>
                        <?php endif; ?>
                                
                    </div>
                </a>
            </div>
            <div class="header-right">
                <ul>
                    <li><a href="#"><i class="fb"> </i></a></li>
                    <li><a href="#"><i class="twt"> </i></a></li>
                    <div class="clearfix"></div>
                </ul>
            </div>
            <div class="clearfix"> </div>
        </div>
        <div class="head-nav">
        <span class="menu"> </span>
            <ul class="cl-effect-15">
                
                <?php if (Yii::$app->user->isGuest) : ?>
                    <?= $this->render('../menus/defaultMenu') ?>
                <?php else : ?>
                    <?= $this->render('../menus/loggedMenu') ?>
                <?php endif; ?>
                    
                <div class="clearfix"> </div>
            </ul>
        </div>	 
    </div> 
</div>
    <div id="baziNagyErtelmetlenFeherCsik" style="width:100%;height: 100px;background-color:#fff">
        
    </div>
<div class="container">
    
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
    
    <?= Alert::widget() ?>
    
    <?= $content ?>
</div>
</div>
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>
    
<?php $this->endBody() ?>
    
</body>
</html>

<?php $this->endPage() ?>
