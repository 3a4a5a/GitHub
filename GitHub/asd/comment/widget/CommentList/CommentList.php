<?php

namespace common\modules\comment\widget\CommentList;

use yii\base\Widget;
use common\modules\comment\models\Comment;

class CommentList extends Widget
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
        CommentListAsset::register($this->getView());
        
        $commentQuery = Comment::find()
                ->with('user', 'post')
                ->where(['post_id' => $this->postId])
                ->orderBy(['created_at' => SORT_DESC]);
        $commentProvider = new \yii\data\ActiveDataProvider([
            'query' => $commentQuery,
        ]);
        
        return $this->render('@common/modules/comment/views/comments', [
            'widget'          => $this,
            'commentProvider' => $commentProvider,
            'postId'          => $this->postId,
            'moderation'      => $this->moderation,
        ]);
    }
}
?>