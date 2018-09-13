<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'name' => 'Blogger',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'common\modules\site\controllers',
    'defaultRoute' => '/site/default/feed',
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
        'errorHandler' => [
            'errorAction' => 'site/default/error',
        ],
        'urlManager' => [
            'rules' => [
                '<module>/<controller>/<action>/<id:\d+>' => '<module>/<controller>/<action>',
                
                // Site
                '/' => '/site/default/feed',
                '/site/feed' => '/site/default/feed',
                '/site/about' => '/site/default/about',
                '/site/contact' => '/site/default/contact',
                
                // User / Authentication
                'user' => '/user/profile/view',
                'user/profile' => '/user/profile/view',
                'user/login' => '/user/authentication/login',
                'user/register' => '/user/authentication/register',
                'user/logout' => '/user/authentication/logout',
                
                // User / Profile
                'user/profile/' => '/user/profile/view',
                'user/profile/view' => '/user/profile/view',
                
                // User / Settings
                'user/settings/' => '/user/settings/main',
                'user/settings/main' => '/user/settings/main',
                
                // Post
                'post/upload' => '/post/default/upload',
                'post/view' => '/post/default/view',
                'post/edit' => '/post/default/edit',
                'post/search' => '/post/default/search',
                'post/wall' => '/post/default/wall',
                
                // Comment
                'comment/ajax/addComment' => '/comment/ajax/addComment',
                'comment/ajax/deleteComment' => '/comment/ajax/deleteComment',
                'comment/ajax/moderateComment' => '/comment/ajax/moderateComment',
                
                // Label
                'label' => '/label/default/index',
                'label/view' => '/label/default/view',
                
            ],
        ],
    ],
    'params' => $params,
];
