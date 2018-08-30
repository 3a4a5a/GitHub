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
        // When the search request comes in
        if (Yii::$app->request->isAjax) {
            $postId = Yii::$app->request->post('postId');
            $searchString = Yii::$app->request->post('searchString');
            
            $postProvider = new ActiveDataProvider([
                'query' => Post::find()
                    ->leftJoin('project', 'post.project_id = project.id')
                    ->where([
                        'post.user_id' => Yii::$app->user->id,
                        'project_id' => $projectId,
                    ])
                    >andFilterWhere([
                        'or',
                        ['like', 'profiles.first_name', $this->userFullName],
                        ['like', 'profiles.last_name', $this->userFullName],
                    ])
                    ->orderBy(['post.created_at' => SORT_DESC]),
            ]);
            
            $posts = $this->controller->renderPartial('../fragments/listings/posts', [
                'postProvider' => $postProvider,
                'pjaxMessage' => '',
            ]);
                
            Yii::$app->response->format = Response::FORMAT_JSON;
            
            return [
                'posts' => $posts,
            ];
        }
    }
}