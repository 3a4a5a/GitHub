<?php

namespace frontend\bundles;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class PostAsset extends AssetBundle
{
    public $publishOptions = [
        'forceCopy' => true,
    ];
    public $sourcePath = '@frontend/assets/post';
    public $css = [
        'css/post.css',
        'css/upload.css',
    ];
    public $js = [
        
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
