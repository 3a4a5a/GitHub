<?php

namespace common\modules\site\actions;

class AboutAction extends \yii\base\Action
{

    public function run()
    {        
        return $this->controller->render('about');
    }
}