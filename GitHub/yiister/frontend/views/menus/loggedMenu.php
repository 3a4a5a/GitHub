<?php

/* @var $this \yii\base\View */

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
                'label' => 'Profile',
                'active' => (strpos(Yii::$app->request->getUrl(), '/user/profile') === 0),
                'url'  => ['/user/profile',
                'id' => Yii::$app->user->id]],
            [
                'label' => 'Settings',
                'active' => (strpos(Yii::$app->request->getUrl(), '/user/settings') === 0),
                'url'  => ['/user/settings']
            ],
            /*[
                'label' => 'Contact',
                'active' => (strpos(Yii::$app->request->getUrl(), '/site/contact') === 0),
                'url'  => ['/site/contact']
            ],
            [
                'label' => 'About',
                'active' => (strpos(Yii::$app->request->getUrl(), '/site/about') === 0),
                'url'    => ['/site/about']
            ],*/
            [
                'label' => 'Log out',
                'active' => (strpos(Yii::$app->request->getUrl(), '/user/logout') === 0),
                'url'  => ['/user/logout']
            ],
        ],
    ]); ?>
    
<?php NavBar::end(); ?>