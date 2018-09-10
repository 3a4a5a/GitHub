<?php

namespace common\modules\label\actions;

use Yii;
use yii\base\Action;
use yii\data\ActiveDataProvider;
use common\modules\post\models\Post;
use common\modules\label\models\Label;

class ViewAction extends Action
{
    

    public function run($name = "")
    {
        /* INIT */
        $c = $this->controller;
        $selectedLabels = array();
        $IdsOfPostsAlreadyIn = array();
        
        // Ebbe lesznek belepumpálva a megjelenítendő bejegyzések.
        $posts = array();
        
        if (Yii::$app->request->isAjax && Yii::$app->request->post('labels')) {
            // A view-ból jön, egy array küld POST-ban amit le kell kérni.
            $labelsSelectedInView = Yii::$app->request->post('labels');
            
            if ($labelsSelectedInView != null && count($labelsSelectedInView) > 0) {
            foreach ($labelsSelectedInView as $labelNameKey => $labelNameValue) {
                $label = Label::find()
                        ->where([
                            'name' => $labelNameKey
                        ])->one();

                if ($label != null && $label instanceof Label) {
                    $merge = true;

                    foreach ($label->posts as $post) {
                        if (!in_array($post->id, $IdsOfPostsAlreadyIn)) {
                            $IdsOfPostsAlreadyIn[] = $post->id;
                            $posts[] = $post;
                        }
                    }

                    // Bővítsük a selected labels-t is, hogy aztán a view-ban be
                    // legyen csekkolva (szó szerint "csekkolva").
                    $selectedLabels[] = $labelNameKey;
                }
            }
        }
        }
        
        /**
         * A "$name" paraméter opcionális, ha van, az itt van kezelve.
         * A fenti foreach key alapján dolgozik, ezért nem oda van bedobva
         * 0. paraméternek. Elég sok kód ismétlés van így, refaktort igényel.
         */
        
        if ($name != "") {
            $optlabel = Label::find()
                    ->where([
                        'name' => $name
                    ])->one();
            
            if ($optlabel != null && $optlabel instanceof Label) {
                foreach ($optlabel->posts as $post) {
                    if (!in_array($post->id, $IdsOfPostsAlreadyIn)) {
                        $IdsOfPostsAlreadyIn[] = $post->id;
                        $posts[] = $post;
                        $selectedLabels[] = $name;
                    }
                }
            }
        }
        
        $labels = Label::find()->all();
        
        return $c->render('view', [
            'labels' => $labels,
            'posts' => $posts,
            'selectedLabels' => $selectedLabels,
        ]);
    }
}