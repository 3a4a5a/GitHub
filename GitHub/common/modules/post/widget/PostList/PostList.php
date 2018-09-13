<?php

namespace common\modules\post\widget\PostList;

use Yii;
use yii\base\Widget;
use common\modules\post\widget\PostList\PostListAsset;
use yii\data\ActiveDataProvider;
use common\modules\post\models\Post;
use common\modules\post\models\PostListing;

class PostList extends Widget
{
    /*
     * active, inactive, deleted, recent
     */
    public $mode = 'active';
    
    // Only show posts from Yii::$app->user->id
    public $currentUser = false;
    
    // Ha van user id akkor csak attól a usertől mutassuk a bejegyzéseket
    public $user_id = null;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        // Az Asset Bundle regisztrálása
        PostListAsset::register($this->getView());
        
        $query = new \yii\db\Query();
        
        if ($this->mode == 'active') {
            $query = PostListing::getActivePosts();
        } else if ($this->mode == 'inactive') {
            $query = PostListing::getInactivePosts();
        } else if ($this->mode == 'deleted') {
            $query = PostListing::getRemovedPosts();
        } else if ($this->mode == 'recent') {
            $query = PostListing::getRecentPosts();
        }
        
        if ($this->currentUser) {
            $query->andWhere([
                'user_id' => Yii::$app->user->id,
            ]);
        }
        
        $dataProvider = new ActiveDataProvider([
           'query' => $query,
        ]);
        
        // A view renderelése
        return $this->render('@common/modules/post/views/partial/postListing', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
?>