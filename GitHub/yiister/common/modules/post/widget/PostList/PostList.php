<?php

namespace common\modules\post\widget\PostList;

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

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        // Az Asset Bundle regisztrálása
        PostListAsset::register($this->getView());
        
        if ($this->mode == 'active') {
            $dataProvider = new ActiveDataProvider([
                'query' => PostListing::getActivePosts(),
            ]);
        } else if ($this->mode == 'inactive') {
            $dataProvider = new ActiveDataProvider([
                'query' => PostListing::getInactivePosts(),
            ]);
        } else if ($this->mode == 'deleted') {
            $dataProvider = new ActiveDataProvider([
                'query' => PostListing::getRemovedPosts(),
            ]);
        } else if ($this->mode == 'recent') {
            $dataProvider = new ActiveDataProvider([
                'query' => PostListing::getRecentPosts(),
            ]);
        }
        
        // A view renderelése
        return $this->render('@common/modules/post/views/partial/postListing', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
?>