<?php

namespace common\modules\user\actions\settings;

/* @var $user \common\modules\user\models\User */
/* @var $editProfileInfoForm \common\modules\user\models\forms\EditProfileInfoForm */

use common\modules\comment\models\Comment;
use common\modules\post\models\forms\PostComment;
use common\modules\user\models\User;
use common\modules\project\models\Project;
use common\modules\user\models\forms\PersonalForm;
use Yii;
use yii\base\Action;
use yii\data\ActiveDataProvider;
use yii\widgets\ActiveForm;
use yii\web\Response;

class PersonalAction extends Action
{
    public function run()
    {
        $model = new PersonalForm();
        
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
                Yii::$app->session->setFlash('success', 'Changes saved');
            }
            
            return $this->controller->redirect(['personal', 
                'model' => $model,
            ]);
        }
        
        // Filling up inital data for the form
        $user = User::findOne(Yii::$app->user->id);
        $model->setAttributes($user->getAttributes());
        
        return $this->controller->render('personal', [
            'model' => $model,
        ]);
    }
}