<?php

namespace common\modules\label\controllers;

use yii\web\Controller;

/**
 * Default controller for the `comment` module
 */
class DefaultController extends Controller
{
    public function actions()
    {
        return [
            'index' => \common\modules\label\actions\IndexAction::class,
            'view' => \common\modules\label\actions\ViewAction::class,
        ];
    }
}
