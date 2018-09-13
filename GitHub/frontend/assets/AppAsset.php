<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/layout/site.css',
        'css/layout/rightPanel.css',
        'css/layout/trumpinusTheme.css',
        'css/layout/navbar.css',
        'css/layout/dropDown.css',
        'css/post/comment.css',
        'css/post/postFragment.css',
        
        'css/label.css',
        'css/loadingAnimation.css',
    ];
    public $js = [
        
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
