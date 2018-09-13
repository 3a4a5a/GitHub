<?php

namespace common\modules\site\actions;

use Yii;

class FeedAction extends \yii\base\Action
{

    public function run($show = 'all')
    {
       $data['show'] = $show;
       
       return $this->controller->render('feed', [
           'data' => $data,
       ]);
    }
}