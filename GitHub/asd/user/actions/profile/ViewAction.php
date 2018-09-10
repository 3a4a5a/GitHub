<?php

namespace common\modules\user\actions\profile;

// Yii
use Yii;

// Custom
use common\modules\user\models\User;
use common\modules\follow\models\Follow;
use common\modules\post\models\Post;
use common\modules\comment\models\Comment;

class ViewAction extends \yii\base\Action
{
    public function run($id)
    {
        /************************
         * Init
         ***********************/
        $c = $this->controller;
        $user = User::findOne($id);
        $ownProfile = false;
        $follows = false;
        if (Yii::$app->user->id == $id) {
            $ownProfile = true;
        } else {
            $follow = Follow::find()->where([
                'follower_id' => Yii::$app->user->id,
                'followed_id' => $id,
            ])->all();
            
            if ($follow != null) {
                $follows = true;
            }
        }
        /************************/
        
        if (Yii::$app->request->post()) {
            $action = Yii::$app->request->post('action');
            $userId = Yii::$app->request->post('userId');
            if ($action == 'follow') {
                $follow = new Follow();
                $follow->follower_id = Yii::$app->user->id;
                $follow->followed_id = $userId;
                $follow->save();
            } else if ($action == 'unfollow') {
                $follow = Follow::find()->where([
                    'follower_id' => Yii::$app->user->id,
                    'followed_id' => $id,
                ])->all();
                
                $follow = $follow[0];
                
                if ($follow != null) {
                    $follow->delete();
                }
            } else if ($action == 'delete') {
                $postId = Yii::$app->request->post('postId');
                $post = Post::findOne($postId);
                $post->status = 2; // 2-> Törölt.
                $post->save();
            }
            
            return $c->refresh();
        }
        
        // Aktív bejegyzések lekérése
        $activePostProvider = new \yii\data\ActiveDataProvider([
            'query' => $posts = Post::find()->where([
                'user_id' => $id,
                'status' => 1,
            ])->with('user', 'comments')
            ->orderBy(['created_at' => SORT_DESC]),
        ]);
        
        // Törölt bejegyzések lekérése
        $removedPostProvider = new \yii\data\ActiveDataProvider([
            'query' => $posts = Post::find()->where([
                'user_id' => $id,
                'status' => 2, // 2-> törölt.
            ])->with('user')
            ->orderBy(['created_at' => SORT_DESC])
        ]);
        
        // Inaktív bejegyzések lekérése
        $inactivePostProvider = new \yii\data\ActiveDataProvider([
            'query' => $posts = Post::find()->where([
                'user_id' => $id,
                'status' => 0,
            ])->with('user')
            ->orderBy(['created_at' => SORT_DESC]),
        ]);
        
        // Top 5 legnézettebb bejegyz.
        $topFiveViewedPosts = Post::find()
                ->where([
                    'user_id' => $id,
                ])
                ->orderBy(['hits_count' => SORT_DESC])
                ->limit(5)
                ->all();
        
        /*
         * Countok
         */
        // inaktív bejegyz. (piszkozatok)
        $inactivePostCount = Post::find()->where([
            'user_id' => $id,
            'status' => 0 // 0 -> piszkozat
        ])->count();
        
        // aktív bejegyz. 
        $activePostCount = Post::find()->where([
            'user_id' => $id,
            'status' => 1 // 1 -> aktív
        ])->count();
        
        // aktív bejegyz. 
        $removedPostCount = Post::find()->where([
            'user_id' => $id,
            'status' => 2 // 2 -> törölt
        ])->count();
        
        // követők
        $followCount = Follow::find()->where([
            'followed_id' => $id,
        ])->count();
        
        // Összes komment
        $overallCommentCount = Post::find()->where([
            'user_id' => Yii::$app->user->id,
        ])->sum('commentCount');
        
        // Top 5 legkommenteltebb
        $topFiveCommented = Post::find()->where([
            'user_id' => Yii::$app->user->id,
        ])->orderBy(['commentCount' => SORT_DESC])
                ->limit(5)
                ->all();
        
        return $c->render('view', [
            'user' => $user,
            'ownProfile' => $ownProfile,
            'follows' => $follows,
            'activePostProvider' => $activePostProvider,
            'inactivePostProvider' => $inactivePostProvider,
            'removedPostProvider' => $removedPostProvider,
            'topFiveCommented' => $topFiveCommented,
            'topFiveViewedPosts' => $topFiveViewedPosts,
            
            // Countok
            'followCount' => $followCount,
            'inactivePostCount' => $inactivePostCount,
            'activePostCount' => $activePostCount,
            'removedPostCount' => $removedPostCount,
            'overallCommentCount' => $overallCommentCount,
        ]);
    }
}