<?php

namespace common\modules\user\controllers;

use Yii;
use yii\web\Controller;

/**
 * Default controller for the `user` module
 */
class AuthenticationController extends Controller
{
    public function actions()
    {
        return [
            'activate' => \common\modules\user\actions\authentication\ActivateAction::class,
            'login' => \common\modules\user\actions\authentication\LoginAction::class,
            'logout' => \common\modules\user\actions\authentication\LogoutAction::class,
            'register' => \common\modules\user\actions\authentication\RegisterAction::class,
            
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    
    public function getViewPath()
    {
        return Yii::getAlias('@common/modules/user/views/sections/authentication');
    }
}
