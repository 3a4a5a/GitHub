<?php

use yii\widgets\DetailView;

$this->title = 'Yiister | My profile';
$this->params['breadcrumbs'][] = 'My profile';

?>

<div class="myProfile">
   <div class="row">
        <div class="col-md-6">
            <?= DetailView::widget([
                'model'      => $model,
                'attributes' => [
                    'name',
                    'username',
                    'first_name',
                    'last_name',
                    'email',
                    'created_at'
                ]
            ]) ?>
        </div>
   </div>
</div>