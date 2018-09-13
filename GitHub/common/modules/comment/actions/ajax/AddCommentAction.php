<?php

namespace common\modules\comment\actions\ajax;

use Yii;
use common\modules\post\models\Post;
use common\modules\post\models\forms\PostComment;
use common\modules\comment\models\Comment;

class AddCommentAction extends \yii\base\Action
{
    public function run()
    {
        // Komment beérkezése
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
           
            // Form model feltöltése
            $postComment = new PostComment();
            $commentText = Yii::$app->request->post('commentText');
            $postId = Yii::$app->request->post('postId');
            $postComment->text = $commentText;
            $postComment->post_id = $postId;

            // Komment mentése
            $commentId = $postComment->saveComment();
            if ($commentId == 0) {
                return ['success' => false];
            }
            
            // Megállapítás, hogy a komment moderálható lesz-e
            $moderation = false;
            $post = Post::find()->where(['id' => $postId])
                        ->one();
                    
            if ($post->user_id == Yii::$app->user->id) {
                $moderation = true;
            }
            
            // AJAX válasz létrehozása
            $freshComment = Comment::find()->where(['id' => $commentId])->one();
            $freshCommentFrag = $this->controller->renderPartial('partial/fragment/_comment', [
                'model'      => $freshComment,
                'moderation' => $moderation,
                'ghostMode'  => false,
            ]);
            
            // AJAX válasz küldése
            return [
                'success'      => true,
                'freshComment' => $freshCommentFrag,
            ];
       }
    }
}