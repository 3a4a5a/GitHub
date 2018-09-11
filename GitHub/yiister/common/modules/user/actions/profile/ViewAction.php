<?php

namespace common\modules\user\actions\profile;

use Yii;
use common\modules\user\models\User;

class ViewAction extends \yii\base\Action
{
    public function run($id)
    {
        $model = User::findOne($id);
        
        return $this->controller->render('view', [
            'model' => $model,
        ]);
    }
}