<?php

namespace common\modules\comment\widget\RecentComments;

use yii\web\AssetBundle;

class RecentCommentsAsset extends AssetBundle
{
    public $sourcePath = __DIR__ . "/assets";
    public $publishOptions = [
        'forceCopy' => true,
    ];
    
    public $js = [
        
    ];

    public $css = [
        'css/recentComments.css',
    ];

    public $depends = [
        'yii\web\JqueryAsset'
    ];
}