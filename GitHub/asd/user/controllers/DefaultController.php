<?php

namespace common\modules\user\controllers;

use yii\web\Controller;

/**
 * Default controller for the `user` module
 */
class DefaultController extends Controller
{
    public function actions()
    {
        return [
            'login' => \common\modules\user\actions\authentication\LoginAction::class,
            'logout' => \common\modules\user\actions\authentication\LogoutAction::class,
            'register' => \common\modules\user\actions\authentication\RegisterAction::class,
            
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
}
