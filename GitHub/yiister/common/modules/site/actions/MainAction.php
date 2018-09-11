<?php

namespace common\modules\site\actions;

use common\modules\post\models\PostListing;
use yii\data\ActiveDataProvider;

class MainAction extends \yii\base\Action
{

    public function run()
    {        
        return $this->controller->render('main', [
            
        ]);
    }
}