<?php

namespace common\modules\user\actions\authentication;

use Yii;
use common\modules\user\models\forms\LoginForm;

class LoginAction extends \yii\base\Action
{

    public function run()
    {
        $c = $this->controller;
        if (!Yii::$app->user->isGuest) {
            return $c->goHome();
        }

        $model = new LoginForm();
        
        if (Yii::$app->request->post()) {
            if ($model->load(Yii::$app->request->post()) && $model->login()) {
                return $c->goBack();
            } else {
                if ($model->notActivated) {
                    Yii::$app->session->setFlash('error', 'Your account is not activated yet.');
                    
                    return $c->redirect(['/user/login',
                        'model' => $model,
                    ]);
                }
            }
        }
        
        $model->password = '';

        return $c->render('login', [
            'model' => $model,
        ]);
    }
}