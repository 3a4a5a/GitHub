<?php

/**
 * 
 */

namespace common\modules\comment\widget\CommentList;

use yii\base\Widget;
use yii\helpers\Html;
use common\modules\comment\models\Comment;

class CommentList extends Widget{
    

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        // Az Asset Bundle regisztrálása
        CommentListAsset::register($this->getView());
        
        $commentQuery = Comment::find()->with('user');
        $commentProvider = new \yii\data\ActiveDataProvider([
                'query' => $commentQuery,
        ]);
        
        return $this->render('comments', [
            'commentProvider' => $commentProvider,
        ]);
    }
}
?>