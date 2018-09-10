<?php
namespace common\modules\site\controllers;

use yii\web\Controller;

/**
 * Site controller
 */
class DefaultController extends Controller
{
    public function actions()
    {
        return [
            'index' => \common\modules\site\actions\BoardAction::class,
            'error' => \yii\web\ErrorAction::class,
        ];
    }
}
