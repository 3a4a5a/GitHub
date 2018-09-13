<?php

namespace common\modules\user\controllers;

use Yii;
use yii\web\Controller;

/**
 * Default controller for the `user` module
 */
class SettingsController extends Controller
{
    public function actions()
    {
        return [
            'main' => \common\modules\user\actions\settings\MainAction::class,
        ];
    }
    
    public function getViewPath()
    {
        return Yii::getAlias('@common/modules/user/views/sections/settings');
    }
}
