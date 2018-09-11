<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'name' => 'eProjekt',
    'defaultRoute' => 'site/default/main',
    'basePath' => dirname(__DIR__),
    'layoutPath' => '@frontend/views/layouts',
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\modules\user\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'error/error',
        ],
        'request'=>[
            'class' => 'common\components\Request',
            'web'=> '/frontend/web'
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                // Site
                '/' => 'site/default/main',
                'site' => 'site/default/main',
                'site/main' => 'site/default/main',
                'site/contact' => 'site/default/contact',
                'site/about' => 'site/default/about',
                
                // User
                'user' => 'user/default',
                
                // User / Settings
                'user/settings' => 'user/settings/personal',
                
                // User / Authentication
                'user/activate' => 'user/authentication/activate',
                'user/register' => 'user/authentication/register',
                'user/login' => 'user/authentication/login',
                'user/logout' => 'user/authentication/logout',
                
                // User / Profile
                'user/profile' => 'user/profile/view',
                
                // User / Settings
                'user/settings' => 'user/settings/personal',
                
                // Post
                'posts' => 'post/default/show',
                'posts/show' => 'post/default/show',
                'posts/search' => 'post/default/search',
            ]
        ],
    ],
    'params' => $params,
];
