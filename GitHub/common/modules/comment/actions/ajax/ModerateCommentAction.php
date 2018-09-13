<?php

namespace common\modules\comment\actions\ajax;

use Yii;
use common\modules\post\models\Post;
use yii\helpers\ArrayHelper;
use common\modules\comment\models\Comment;
use common\modules\label\models\Label;
use common\modules\postlabel\models\PostLabel;
use yii\web\Response;

class ModerateCommentAction extends \yii\base\Action
{

    public function run()
    {
        // Kérés érkezett egy komment moderálására
        if (Yii::$app->request->isAjax) {
            
            // POST Adatok betöltése
            $commentId = Yii::$app->request->post('commentId');
            $commentText = Yii::$app->request->post('commentText');
            
            $result = Comment::updateAll(
                [
                    'text'      => $commentText,
                    'moderated' => 1,
                ],
                ['id' => $commentId]
            );
            
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