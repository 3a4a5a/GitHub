<?php

namespace common\modules\comment\actions\ajax;

use Yii;
use common\modules\comment\models\Comment;
use yii\web\Response;

class DeleteCommentAction extends \yii\base\Action
{

    public function run()
    {
        // Kérés érkezett egy komment törlésére
        if (Yii::$app->request->isAjax) {
            
            // POST Adatok betöltése
            $commentId = Yii::$app->request->post('commentId');
            
            $result = Comment::deleteAll([
                'id' => $commentId,
            ]);
            
            $success;
            if ($result != 0) {
                $success = true;
            } else {
                $success = false;
            }
            
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'success' => $success,
            ];
        }
    }
}