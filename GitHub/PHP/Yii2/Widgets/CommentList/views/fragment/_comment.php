<?php

/* @var $commentAuthor common\modules\user\models\User */

?>

<div class="comment">
    <div class='commentAuthor'>
       <?= $model->user->username ?>
    </div>
    <div class='commentText'>
       <?= $model->text ?>
    </div>
</div>