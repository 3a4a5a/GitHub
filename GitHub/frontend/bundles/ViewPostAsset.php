<?php

namespace frontend\bundles;

use yii\web\AssetBundle;

class ViewPostAsset extends AssetBundle
{
    public $sourcePath = '@frontend/assets/post';
    public $css = [
        'css/view.css',
    ];
    public $js = [
        
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
