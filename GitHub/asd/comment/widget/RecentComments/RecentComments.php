<?php

namespace common\modules\comment\widget\RecentComments;

use yii\base\Widget;
use common\modules\comment\models\Comment;

class RecentComments extends Widget
{
    public $postId;
    public $moderation = false;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        // Az Asset Bundle regisztrálása
        RecentCommentsAsset::register($this->getView());
        
        $query = Comment::find()
                ->with('post')
                ->orderBy(['created_at' => SORT_DESC]);
        
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
        ]);
        
        return $this->render('@common/modules/comment/views/partial/recentComments', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
?>