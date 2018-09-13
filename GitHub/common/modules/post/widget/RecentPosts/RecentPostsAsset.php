<?php

namespace common\modules\post\widget\RecentPosts;

use yii\web\AssetBundle;

class RecentPostsAsset extends AssetBundle
{
    public $sourcePath = __DIR__ . "/assets";
    public $publishOptions = [
        'forceCopy' => true,
    ];
    
    public $js = [

    ];

    public $css = [
        'css/recentposts.css',
    ];

    public $depends = [
        'yii\web\JqueryAsset'
    ];

    /*public function init()
    {
        parent::init();
    }*/
}