<?php
namespace common\modules\site\controllers;

use Yii;
use yii\web\Controller;

/**
 * Site controller
 */
class DefaultController extends Controller
{
    public function actions()
    {
        return [
            'about' => \common\modules\site\actions\AboutAction::class,
            'contact' => \common\modules\site\actions\ContactAction::class,
            'feed' => \common\modules\site\actions\FeedAction::class,
            'error' => \yii\web\ErrorAction::class,
        ];
    }
    
    public function getViewPath()
    {
         return Yii::getAlias('@common/modules/site/views');
    }
}
