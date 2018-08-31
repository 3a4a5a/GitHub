<?php

namespace common\modules\comment\widget\CommentList;

use yii\web\AssetBundle;

class CommentListAsset extends AssetBundle
{
    //public $basePath = '@common';
    
    //public $sourcePath = __DIR__ . "/assets";
    
    public $js = [
        'js/main.js'
    ];

    public $css = [
        'css/main.css'
    ];

    public $depends = [
        'yii\web\JqueryAsset'
    ];

    public function init()
    {
        // Tell AssetBundle where the assets files are
        $this->sourcePath = __DIR__ . "/assets";
        parent::init();
    }
}