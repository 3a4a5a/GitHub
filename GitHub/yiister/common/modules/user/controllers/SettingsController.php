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
            'personal' => \common\modules\user\actions\settings\PersonalAction::class,
        ];
    }
    
    public function getViewPath()
    {
        return Yii::getAlias('@common/modules/user/views/sections/settings');
    }
}
