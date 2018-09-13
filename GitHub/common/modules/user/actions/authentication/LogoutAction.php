<?php

namespace common\modules\user\actions\authentication;

use Yii;

class LogoutAction extends \yii\base\Action
{

    public function run()
    {
        Yii::$app->user->logout();

        return $this->controller->goHome();
    }
}