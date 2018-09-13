<?php

namespace common\modules\post\actions;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Response;
use yii\widgets\ActiveForm;
use common\modules\label\models\Label;
use common\modules\post\models\forms\UploadPostForm;

class UploadAction extends \yii\base\Action
{

    public function run()
    {
        $c = $this->controller;
        $uploadPostForm = new UploadPostForm();
        $labels = ArrayHelper::map(Label::find()->all(), 'name', 'name');
        
        // AJAX validáció
        if (Yii::$app->request->isAjax) {
            $uploadPostForm->load(Yii::$app->request->post());
            
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($uploadPostForm);
        }

        if (Yii::$app->request->post() && $uploadPostForm->load(Yii::$app->request->post())) {
            $uploadPostForm->handleImage();
                
            if ($uploadPostForm->validate()) {
                $postId = $uploadPostForm->save(); // Visszajön az id-val
                
                Yii::$app->session->setFlash('success', 'Bejegyzés metnve');
                
                return $c->redirect(['/post/view', 'id' => $postId]);
            }
        }
        
        return $c->render('upload', [
            'uploadPostForm' => $uploadPostForm,
            'labels' => $labels,
        ]);
    }
}