<?php

namespace common\modules\site\controllers;

use Yii;
use yii\web\Controller;

/**
 * Default controller for the `post` module
 */
class DefaultController extends Controller
{
    public function actions()
    {
        return [
            'main' => \common\modules\site\actions\MainAction::class,
            'contact' => \common\modules\site\actions\ContactAction::class,
            'about' => \common\modules\site\actions\AboutAction::class,
        ];
    }
    
    
    public function getViewPath()
    {
        return Yii::getAlias('@common/modules/site/views');
    }
}
