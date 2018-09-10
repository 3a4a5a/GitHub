<?php

namespace common\modules\user\actions\profile;

use common\modules\user\models\forms\EditProfileInfoForm;
use yii\web\Response;
use common\modules\user\models\User;
use yii\widgets\ActiveForm;
use Yii;

class EditAction extends \yii\base\Action
{
    public function run()
    {
        $model = new EditProfileInfoForm();
        
        // Form validation with AJAX
        if (Yii::$app->request->isAjax) {
            $model->load(Yii::$app->request->post());
            
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        
        // Loading the model with the POST values
        if (Yii::$app->request->post() && $model->load(Yii::$app->request->post())) {
            
            // If the save was succesful
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Változtatások mentve');
            }
            
            return $this->controller->redirect(['edit', 
                'model' => $model,
            ]);
        }
        
        // Filling up inital data for the form
        $user = User::findOne(Yii::$app->user->id);
        $model->setAttributes($user->getAttributes());
        
        return $this->controller->render('edit', [
            'model' => $model,
        ]);
    }
}