<?php

namespace common\modules\post\actions;

use Yii;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;

use common\utility\U;
use common\modules\label\models\Label;
use common\modules\post\models\forms\UploadPostForm;

class UploadAction extends \yii\base\Action
{

    public function run()
    {
        $c = $this->controller;
        $uploadPostForm = new UploadPostForm();
        $labels = ArrayHelper::map(Label::find()->all(), 'name', 'name');

        if (Yii::$app->request->post() && $uploadPostForm->load(Yii::$app->request->post())) {
            $uploadPostForm->handleImage();
                
            if ($uploadPostForm->validate()) {
                $postId = $uploadPostForm->save(); // Visszajön az id-val
                return $c->redirect(['/post/view', 'id' => $postId]);
            }
        }
        
        return $c->render('upload', [
            'uploadPostForm' => $uploadPostForm,
            'labels' => $labels,
        ]);
    }
}