<?php

namespace common\modules\comment\controllers;

use Yii;
use yii\web\Controller;
use yii\base\ViewContextInterface;

/**
 * Default controller for the `comment` module
 */
class AjaxController extends Controller implements ViewContextInterface
{
    public function actions()
    {
        return [
            'addComment' => \common\modules\comment\actions\ajax\AddCommentAction::class,
            'moderateComment' => \common\modules\comment\actions\ajax\ModerateCommentAction::class,
            'deleteComment' => \common\modules\comment\actions\ajax\DeleteCommentAction::class,
        ];
    }
    
    public function getViewPath()
    {
        return Yii::getAlias('@common/modules/comment/views');
    }
}
