<?php

namespace common\modules\post\widget\PostList;

use yii\web\AssetBundle;

class PostListAsset extends AssetBundle
{
    public $sourcePath = __DIR__ . "/assets";
    public $publishOptions = [
        'forceCopy' => true,
    ];
    
    public $js = [
        
    ];

    public $css = [
        
    ];

    public $depends = [
        'yii\web\JqueryAsset'
    ];

    /*public function init()
    {
        parent::init();
    }*/
}