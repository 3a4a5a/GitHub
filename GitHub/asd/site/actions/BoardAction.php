<?php

namespace common\modules\site\actions;

use Yii;

class BoardAction extends \yii\base\Action
{

    public function run()
    {
       $c = $this->controller;
       
       return $c->render('index');
    }
}