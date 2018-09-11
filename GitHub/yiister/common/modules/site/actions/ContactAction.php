<?php

namespace common\modules\site\actions;

use Yii;
use common\modules\site\models\forms\ContactForm;

class ContactAction extends \yii\base\Action
{

    public function run()
    {        
        $model = new ContactForm();
        
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->controller->refresh();
        } else {
            return $this->controller->render('contact', [
                'model' => $model,
            ]);
        }
    }
}