<?php

namespace common\modules\post\controllers;

use Yii;
use yii\web\Controller;

/**
 * Default controller for the `post` module
 */
class DefaultController extends Controller
{
    public function actions()
    {
        return [
            'wall' => \common\modules\post\actions\WallAction::class,
            'view' => \common\modules\post\actions\ViewAction::class,
            'upload' => \common\modules\post\actions\UploadAction::class,
            'edit' => \common\modules\post\actions\EditAction::class,
            'search' => \common\modules\post\actions\SearchAction::class,
        ];
    }
    
    /**
     * Nincs 'default' könyvtár, a default dolgok a 'views' mappában vannak simán,
     * egy szinttel feljebb
     */
    public function getViewPath()
    {
        return Yii::getAlias('@common/modules/post/views');
    }
}
