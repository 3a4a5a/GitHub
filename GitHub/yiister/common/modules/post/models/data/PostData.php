<?php

namespace common\modules\post\models\data;

use yii\helpers\Html;
use yii\helpers\Url;

class PostData extends \yii\base\Model
{
    /** @var \common\modules\post\models\Post */
    public $model;
    
    public function getTitle()
    {
        return Html::encode($this->model->title);
    }
    
    public function getTitleLink()
    {
        return Html::a(Html::encode($this->model->title), ['/post/view', 'id' =>$this->model->id]);
    }
}