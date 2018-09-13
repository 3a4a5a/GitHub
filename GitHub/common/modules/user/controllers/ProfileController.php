<?php

namespace common\modules\user\controllers;

use Yii;
use yii\web\Controller;

/**
 * Default controller for the `user` module
 */
class ProfileController extends Controller
{
    public function actions()
    {
        return [
            'view' => \common\modules\user\actions\profile\ViewAction::class,
            'edit' => \common\modules\user\actions\profile\EditAction::class,
        ];
    }
    
    public function getViewPath()
    {
        return Yii::getAlias('@common/modules/user/views/sections/profile');
    }
}
