<?php

namespace common\modules\user\actions\authentication;

use Yii;
use common\modules\user\models\forms\SignupForm;

class RegisterAction extends \yii\base\Action
{

    public function run()
    {
        $c = $this->controller;
        if (!Yii::$app->user->isGuest) {
            return $c->goHome();
        }
        
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $c->goHome();
                }
            }
        }

        return $c->render('signup', [
            'model' => $model,
        ]);
    }
}