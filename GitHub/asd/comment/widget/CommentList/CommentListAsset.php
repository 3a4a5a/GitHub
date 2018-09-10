<?php

namespace common\modules\comment\widget\CommentList;

use yii\web\AssetBundle;

class CommentListAsset extends AssetBundle
{
    public $sourcePath = __DIR__ . "/assets";
    public $publishOptions = [
        'forceCopy' => true,
    ];
    
    public $js = [
        'js/addFunction.js',
        'js/moderateFunction.js',
        'js/deleteFunction.js',
    ];

    public $css = [
        'css/commentlist.css',
    ];

    public $depends = [
        'yii\web\JqueryAsset'
    ];

    /*public function init()
    {
        parent::init();
    }*/
}