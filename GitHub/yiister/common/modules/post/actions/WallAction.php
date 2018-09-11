<?php

namespace common\modules\post\actions;

use common\modules\post\models\PostListing;
use yii\data\ActiveDataProvider;

class WallAction extends \yii\base\Action
{

    public function run($show = 'all')
    {
        $data['show'] = $show;
        
        return $this->controller->render('wall', [
            'data' => $data,
        ]);
    }
}