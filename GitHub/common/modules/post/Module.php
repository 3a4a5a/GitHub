<?php

namespace common\modules\post;

use Yii;
use frontend\bundles\PostAsset;

/**
 * post module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'common\modules\post\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        PostAsset::register(Yii::$app->view);
        
        parent::init();
    }
}
