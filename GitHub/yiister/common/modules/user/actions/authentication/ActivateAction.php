<?php

namespace common\modules\user\actions\authentication;

use Yii;
use common\modules\user\models\User;

class ActivateAction extends \yii\base\Action
{

    public function run($key)
    {
        if (isset($key) && strlen($key) > 0) {
            $user = User::find()->where(['activation_token' => $key])->one();
            
            if ($user instanceof User) {
                $user->status = User::STATUS_ACTIVE;
                $user->activation_token = '';
                $user->save();
                
                Yii::$app->session->setFlash('success', 'Your account has been activated successfully.');
            } else {
                Yii::$app->session->setFlash('error', 'An error occured while activating your account.');
            }
            
            return $this->controller->redirect(['/']);
        }
    }
}