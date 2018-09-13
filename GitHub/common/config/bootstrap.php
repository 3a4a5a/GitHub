<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');

/**
 * A projektet azonosító ID. Fájlnevekben, log azonosítókban van használva.
 * Ezért ajánlott alfranumerikus, illetve alulvonás karakterekre korlátozni a névben használt karaktereket.
 */
defined('PROJECT_ID') or define('PROJECT_ID', 'utasia_blog_yii');

/**
 * Az app localhost environmentben fut-e (fejlesztő gépén).
 */
defined('YII_ENV_LOCAL') or define('YII_ENV_LOCAL', YII_ENV === 'local');

/**
 * Céges intranet publikus IP-je.
 */
defined('INTRANET_PUBLIC_IP') or define('INTRANET_PUBLIC_IP', '217.65.97.10');
defined('INTRANET_PUBLIC_IPV6') or define('INTRANET_PUBLIC_IPV6', '2001:4c48:e:a195::10');
