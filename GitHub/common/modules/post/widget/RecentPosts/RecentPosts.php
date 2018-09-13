<?php

namespace common\modules\post\widget\RecentPosts;

use yii\base\Widget;
use yii\data\ActiveDataProvider;
use common\modules\post\models\PostListing;

class RecentPosts extends Widget
{
    public $postId;
    public $moderation = false;
    public $typesToDisplay = [];

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        // Az Asset Bundle regisztrálása
        RecentPostsAsset::register($this->getView());
        
        $dataProvider = new ActiveDataProvider([
            'query' => PostListing::getRecentPosts(),
            'pagination' => false,
        ]);
        
        // A view renderelése
        return $this->render('@common/modules/post/views/partial/recentPosts', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
?>