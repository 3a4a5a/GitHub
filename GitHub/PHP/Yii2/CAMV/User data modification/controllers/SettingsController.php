<?php

namespace common\modules\user\controllers;
//Yii.
use yii\web\Controller;
//Custom.
use common\modules\user\models\forms\EditProfileInfoForm;
/**
 * Default controller for the `user` module
 */
class SettingsController extends Controller
{
    public function actions()
    {
        return [
            'personal' => \common\modules\user\actions\settings\PersonalAction::className(),
        ];
    }
}
