<?php

namespace frontend\bundles;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class UserAsset extends AssetBundle
{
    public $publishOptions = [
        'forceCopy' => true,
    ];
    public $sourcePath = '@frontend/assets/user';
    public $css = [
        'css/profile.css',
    ];
    public $js = [
        
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
