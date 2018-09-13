<?php

namespace common\modules\post\actions;

use Yii;
use common\modules\post\models\Post;
use yii\helpers\ArrayHelper;
use common\modules\label\models\Label;
use common\modules\postlabel\models\PostLabel;

class EditAction extends \yii\base\Action
{

    public function run($id = '')
    {
        $c = $this->controller;
        
        if ($id == '') {
            $c->goHome();
        }
        
        $post = Post::findOne($id);
        $editPost = new \common\modules\post\models\forms\EditPost();
        
        // Ha nincs ilyen bejegyzés, akkor nincs ilyen action! #owned
        if ($post == null || !$post instanceof Post) {
            $c->goHome();
        }
        
        /*********************
         * A model feltöltése
         *********************/
        $editPost->setAttributes($post->getAttributes());
        $editPost->setupImage();
        $editPost->post_id = $id;
        
        if (Yii::$app->request->post()) {
            $editPost->load(Yii::$app->request->post());
            $editPost->handleImage();
                
            if ($editPost->validate()) {
                $editPost->save();
                Yii::$app->session->setFlash('success', 'Bejegyzés módosítva');
                return $c->redirect([
                    '/user/profile/view',
                    'id' => Yii::$app->user->id
                ]);
            }
        } else if (Yii::$app->request->isAjax && Yii::$app->request->post('action') == 'deletePostPic') {
            $post->image_id = null;
            $post->save();
        }
        
        // Label-ek betöltése
        $ownedLabels = array();
        
        // Egy numerikus offsettel rendelkező label array létrehozása (ActiveFormos hiddenInputhoz),
        // hogy egy for ciklussal végig lehessen loopolni rajtuk is ki lehessen őket íratni
        $numericOwnedLabels = array();
        
        foreach ($post->labels as $label => $labelKey) {
            $ownedLabels[$labelKey->name] = $labelKey->name;
            $numericOwnedLabels[] = $labelKey->name;
        }
        $editPost->labels = $ownedLabels;
        
        $labels = ArrayHelper::map(Label::find()->all(), 'name', 'name');
        
        return $c->render('edit', [
            'editPost' => $editPost,
            'labels' => $labels,
            'ownedLabels' => $numericOwnedLabels,
        ]);
    }
}