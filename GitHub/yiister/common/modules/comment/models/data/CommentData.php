<?php

namespace common\modules\comment\models\data;

use yii\helpers\Html;
use common\helpers\StringHelper;

class CommentData extends \yii\base\Model
{
    /** @var \common\modules\comment\models\Comment */
    public $model;
    
    public function getCommentAtPostText()
    {
        $commentText = StringHelper::truncateString($this->model->text, 15);
        return '"' . $commentText . '" itt: ' . $this->model->post->view->getTitleLink();
    }
}