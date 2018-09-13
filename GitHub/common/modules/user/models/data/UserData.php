<?php

namespace common\modules\user\models\data;

use yii\helpers\Html;
use yii\helpers\Url;

class UserData extends \yii\base\Model
{
    /* @var $model \common\modules\user\models\User */
    public $model;
    protected $viewDataClass = PostData::class;
    
    public function getFullName()
    {
        if (strlen($this->model->first_name) == 0 && strlen($this->model->last_name == 0)) {
            return 'Nincs név megadva';
        }
        
        return Html::encode($this->model->first_name . ' ' . $this->model->last_name);
    }
}