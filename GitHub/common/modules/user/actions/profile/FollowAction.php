<?php

namespace common\modules\user\actions\profile;

/* @var $models['user'] User */

use Yii;
use common\modules\user\models\User;
use common\modules\post\models\Post;

class FollowAction extends \yii\base\Action
{
    public function run()
    {
        $dataProviders = [];
        $models = [];
        $data = [];
        
        $follow = Yii::$app->request->post('FollowForm');
        
        if ($follow) {
            
        }
    }
}