<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\bootstrap\Tabs;
   
?>

<h2 class="trumpinusTitle">Profilom</h2>

<div class="row">
    <div class="col-md-6">

        <?= Tabs::widget([
            'items' => [
                [
                    'label' => 'Személyes',
                    'content' =>  $this->render('../../partials/settings/personal', [
                        'personalForm' => $forms['personalForm'],
                    ]),
                    'active' => true,
                ],
                [
                    'label' => 'Fiók és biztonság',
                    'content' =>  $this->render('../../partials/settings/accountAndSecurity', [
                        'passwordForm' => $forms['passwordForm'],
                    ]),
                ],
            ],
        ]); ?>
        
    </div>
</div>