<?php

namespace common\modules\user\actions\settings;

/* @var $user \common\modules\user\models\User */
/* @var $editProfileInfoForm \common\modules\user\models\forms\EditProfileInfoForm */

use common\modules\user\models\forms\ChangeGeneralForm;
use common\modules\user\models\forms\ChangePasswordForm;
use common\modules\user\models\forms\ChangeEmailForm;
use Yii;
use yii\base\Action;
use common\modules\user\models\User;
use yii\widgets\ActiveForm;
use yii\web\Response;

class PersonalAction extends Action
{
    public function run()
    {
        $generalForm = new ChangeGeneralForm();
        $passwordForm = new ChangePasswordForm();
        $emailForm = new ChangeEmailForm();
        
        if (Yii::$app->request->post()) {
            $model = $this->getForm();
            
            // Form validation with AJAX
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                Yii::$app->response->format = Response::FORMAT_JSON;

                return ActiveForm::validate($model);
            }

            // Loading the model with the POST values if there was a post request
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {

                // If the save was succesful
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Changes saved');
                }

                return $this->controller->redirect(['personal', 
                    'model' => $model,
                ]);
            }
        }
        
        // Filling up inital data for the form
        $user = User::findOne(Yii::$app->user->id);
        $generalForm->setAttributes($user->getAttributes());
        
        return $this->controller->render('personal', [
            'generalForm'  => $generalForm,
            'passwordForm' => $passwordForm,
            'emailForm' => $emailForm,
        ]);
    }
    
    private function getForm()
    {
        if (Yii::$app->request->post('ChangeGeneralForm')) {
            return new ChangeGeneralForm();
        } else if (Yii::$app->request->post('ChangePasswordForm')) {
            return new ChangePasswordForm();
        } else if (Yii::$app->request->post('ChangeEmailForm')) {
            return new ChangeEmailForm();
        }
    }
}