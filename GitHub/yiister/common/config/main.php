<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
    'modules' => [
        'site' => [
            'class' => 'common\modules\site\Module',
        ],
        'user' => [
            'class' => 'common\modules\user\Module',
        ],
        'post' => [
            'class' => 'common\modules\post\Module',
        ],
    ],
];
