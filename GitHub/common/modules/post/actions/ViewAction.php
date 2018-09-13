<?php

namespace common\modules\post\actions;

use Yii;
use common\modules\post\models\Post;
use common\modules\post\models\forms\PostComment;
use common\modules\comment\models\Comment;
use common\modules\user\models\User;
use common\utility\U;
use yii\web\Response;

class ViewAction extends \yii\base\Action
{
    public function run($id)
    {
        $post = Post::findOne($id);
        $this->controller->layout = '@frontend/views/layouts/viewPost';
        
        // Ha a bejegyzés nem található irány a főoldal
        if (!$post) {
            return $c->goHome();
        }
                
        $postComment = new PostComment();
        
        if (Yii::$app->request->isAjax) {
           $action = Yii::$app->request->post('action'); 
           
            // Komment hozzáadása
            if ($action == 'post') {
               $commentText = Yii::$app->request->post('text');
               // Form feltöltés:
               $postComment->text = $commentText;
               $postComment->post_id = $id;

               if ($postComment->saveComment()) {
                   $postComment->incrementCommentCount(); // +1 comment
                   $toastMessage = 'Komment mentve';
               } else {
                   $toastMessage = 'Váratlan hiba történt';
               }
            }
            
            // Komment törlése
            else if ($action == 'delete') {
                $commentId = Yii::$app->request->post('commentId');
                $comment = Comment::findOne($commentId);
                
                if ($comment instanceof Comment) {
                    $comment->delete();
                } else {
                    $toastMessage = 'Hiba történt a komment törlése közben';
                }
                
                Yii::$app->response->format = Response::FORMAT_JSON;
                $commentCount = Comment::find()
                        ->where(['post_id' => $id])
                        ->count();
                
                return [
                    'commentCount' => $commentCount,
                ];
            }
            
            // Komment moderálása (updatelése)
            else if ($action == 'moderate') {
                $commentText = Yii::$app->request->post('commentText');
                $commentId = Yii::$app->request->post('commentId');
                $comment = Comment::findOne($commentId);
                $comment->text = $commentText;
                $comment->moderated = 1;
                $comment->save();
                
                $toastMessage = 'Komment moderálva';
                
                Yii::$app->response->format = Response::FORMAT_JSON;
                return [
                    'toastMessage' => $toastMessage,
                ];
            }
        }
        
        $comments = Comment::find()
                ->where(['post_id' => $id])
                ->with('user')
                ->orderBy(['created_at' => SORT_DESC])
                ->all();
        
        // Látogatottság növelése.
        $post->getBehavior('hit')->touch();
        
        if ($post) {
            return $this->controller->render('view', [
                'post' => $post,
                'comments' => $comments,
            ]);
        }
    }
}