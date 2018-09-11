<?php

namespace common\modules\user\actions\authentication;

use Yii;
use common\modules\user\models\forms\SignupForm;

class RegisterAction extends \yii\base\Action
{

    public function run()
    {
        $model = new SignupForm();
        
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->params['verifiedRegistration'] == true) {
                    Yii::$app->session->setFlash('success', 'Successful registration. A verification email has been sent, please verify your email address.');
                } 
                Yii::$app->session->setFlash('success', 'Successful registration.');
                return $this->controller->render('success');
            }
        }

        return $this->controller->render('register', [
            'model' => $model,
        ]);
    }
}