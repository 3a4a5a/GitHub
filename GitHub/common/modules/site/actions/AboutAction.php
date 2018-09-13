<?php

namespace common\modules\site\actions;

use Yii;

class AboutAction extends \yii\base\Action
{

    public function run()
    {
       $this->controller->render('about');
    }
}