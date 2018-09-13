<?php

namespace common\modules\user\actions\authentication;

use Yii;
use common\modules\user\models\forms\authentication\LoginForm;

class LoginAction extends \yii\base\Action
{

    public function run()
    {
        $c = $this->controller;
        if (!Yii::$app->user->isGuest) {
            return $c->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $c->goBack();
        } else {
            $model->password = '';

            return $c->render('login', [
                'model' => $model,
            ]);
        }
    }
}