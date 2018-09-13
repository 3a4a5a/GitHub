<?php

namespace common\modules\user\actions\profile;

/* @var $models['user'] User */

use Yii;
use common\modules\user\models\User;
use common\modules\post\models\Post;

class ViewAction extends \yii\base\Action
{
    public function run($id)
    {
        $dataProviders = [];
        $models = [];
        $data = [];
        
        $data['id'] = $id;
        $models['user'] = User::findOne($id);
        
        // Ha saját profilról van szó
        if (Yii::$app->user->id == $id) {
            $data['ownProfile'] = true;
            
            /*$dataProviders['mostViewed'] = new \yii\data\ActiveDataProvider([
                'pagination' => false,
                'query'      => $models['user']->getTopFiveMostViewedPosts(),
            ]);
            
            $dataProviders['mostPopular'] = new \yii\data\ActiveDataProvider([
                'pagination' => false,
                'query'      => $models['user']->getTopFiveMostPopularPosts(),
            ]);*/
            
            $models['mostViewedPosts']  = $models['user']->getTopFiveMostViewedPosts()->all();
            $models['mostPopularPosts'] = $models['user']->getTopFiveMostPopularPosts()->all();
        } 
        
        // Egyébként nézzük meg, követi-e a felhasználót a profil látogató
        else {
            $data['follows'] = $models['user']->checkIfFollows($id);
        }
        
        return $this->controller->render('view', [
            'dataProviders' => $dataProviders,
            'models'        => $models,
            'data'          => $data,
        ]);
    }
}