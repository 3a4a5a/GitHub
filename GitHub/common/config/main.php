<?php
return [
    'language' => 'hu',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'bootstrap' => ['log'],
    'components' => [
            'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'locale' => 'hu-HU',
            'defaultTimeZone' => 'Europe/Budapest',
            'dateFormat' => 'php:Y/m/d',
            'datetimeFormat' => 'php:Y/m/d H:i:s',
            'timeFormat' => 'php:H:i:s',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\SyslogTarget',
                    'identity' => PROJECT_ID . '-' . YII_ENV,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        // Közös adatbázis beállítások. A kapcsolódási adatok environmentenként eltérőek.
        'db' => [
            'class' => 'yii\db\Connection',
            'charset' => 'utf8',
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\DbMessageSource',
                    'db' => 'db',
                    'sourceLanguage' => 'xx-XX', // Developer language
                    'sourceMessageTable' => '{{%language_source}}',
                    'messageTable' => '{{%language_translate}}',
                    'cachingDuration' => 3600,
                    'enableCaching' => YII_ENV_PROD,
                ],
                // A framework üzenetei le vannak fordítva elég sok nyelvre, így azokat a fordításokat használjuk.
                // Ha mégis mi szeretnénk őket lefordítani, akkor ez a rész törölhető.
                'yii' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => "@vendor/yiisoft/yii2/messages",
                    'sourceLanguage' => 'en',
                    'fileMap' => [
                        'yii' => 'yii.php',
                    ]
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        'oldalinfo' => [
            'class' => 'wwdh\oldalinfo\Client',
            'apiKey' => '', // Megadása itt opcionális. Később is értéket lehet neki adni az apiKey attribútumon keresztül.
        ],
        'mailer' => [
            'class' => 'wwdh\sendmail\Mailer',
            'viewPath' => '@common/mail',
            'apiKey' => '', // Az oldalhoz tartozó API kulcs.
            // Üzenet alapértelmezett beállításai:
//            'messageConfig' => [
//                'from' => ['noreply@test.hu' => 'Test Site'], // Alapértelmezett feladó
//            ],
        ],
    ],
    'modules' => [
        'commandmanager' => [
            'class' => \wwdh\commandmanager\Module::class,
            'roles' => ['developer'],
            'allowedIPs' => ['127.0.0.1', '::1', INTRANET_PUBLIC_IP, INTRANET_PUBLIC_IPV6],
        ],
        'translatemanager' => [
            'class' => 'lajax\translatemanager\Module',
        ],
        'user' => [
            'class' => 'common\modules\user\Module',
        ],
        'admin' => [
            'class' => 'common\modules\admin\Module',
        ],
        'post' => [
            'class' => 'common\modules\post\Module',
        ],
        'comment' => [
            'class' => 'common\modules\comment\Module',
        ],
        'image' => [
            'class' => 'common\modules\image\Module',
        ],
        'site' => [
            'class' => 'common\modules\site\Module',
        ],
        'label' => [
            'class' => 'common\modules\label\Module',
        ],
        'postlabel' => [
            'class' => 'common\modules\postlabel\Module',
        ],
    ],
];
