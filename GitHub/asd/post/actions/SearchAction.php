<?php
namespace common\modules\post\actions;
use common\modules\comment\models\Comment;
use common\modules\post\models\forms\PostComment;
use common\modules\post\models\Post;
use common\modules\project\models\Project;
use Yii;
use yii\base\Action;
use yii\data\ActiveDataProvider;
use yii\web\Response;
class SearchAction extends Action
{
    public function run()
    {
        /* Init */
        $empty = 'empty';
        $posts = null;
        
        // When the search request comes in
        if (Yii::$app->request->isAjax) {
            $searchString = Yii::$app->request->post('searchString');
            
            $postProvider = new ActiveDataProvider([
                'query' => Post::find()
                    ->where([
                        'status' => 1,
                    ])
                    ->andFilterWhere([
                        'or',
                        ['like', 'post.title', $searchString],
                        ['like', 'post.lead', $searchString],
                        ['like', 'post.text', $searchString],
                    ])
                    ->orderBy(['post.created_at' => SORT_DESC])
                    ->with('user'),
            ]);
            
            if ($postProvider->getTotalCount() != 0) {
                $empty = 'notEmpty';
                
                $posts = $this->controller->renderPartial('@common/modules/post/views/fragments/standalone/postList', [
                    'postProvider' => $postProvider,
                    'pjaxMessage' => '',
                ]);
            }
                
            Yii::$app->response->format = Response::FORMAT_JSON;
            
            return [
                'posts'      => $posts,
                'empty'      => $empty,
                'matchCount' => $postProvider->getTotalCount(),
            ];
        }
    }
}