<?php

use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;

?>

<?php NavBar::begin([
    'brandLabel' => Yii::$app->name,
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top',
    ],
])?>

    <?= Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            [
                'label'  => 'Posts',
                'url'    => ['/'],
                'active' => (strpos(Yii::$app->request->getUrl(), '/') === 0) && (strlen(Yii::$app->request->getUrl()) == 1),
            ],
            [
                'label' => 'Login',
                'active' => (strpos(Yii::$app->request->getUrl(), '/user/login') === 0),
                'url'  => ['/user/login']
            ],
            [
                'label' => 'Register',
                'active' => (strpos(Yii::$app->request->getUrl(), '/user/register') === 0),
                'url'  => ['/user/register']
            ],
            [
                'label' => 'Contact',
                'active' => (strpos(Yii::$app->request->getUrl(), '/site/contact') === 0),
                'url'  => ['/site/contact']
            ],
            [
                'label' => 'About',
                'active' => (strpos(Yii::$app->request->getUrl(), '/site/about') === 0),
                'url'    => ['/site/about']
            ],
        ],
    ]); ?>
    
<?php NavBar::end(); ?>