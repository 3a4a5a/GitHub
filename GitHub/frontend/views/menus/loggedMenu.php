<?php

/* @var $this \yii\base\View */

use yii\helpers\Url;

?>

<li><a href="<?= Url::toRoute(['/'], true) ?>" data-hover="ÜZENŐFAL">ÜZENŐFAL</a></li>
<li><a href="<?= Url::toRoute(['/label/view'], true) ?>" data-hover="KATEGÓRIÁK">KATEGÓRIÁK</a></li>
<li><a href="<?= Url::toRoute(['/post/upload'], true) ?>" data-hover="BEJEGYZÉS ÍRÁSA">BEJEGYZÉS ÍRÁSA</a></li>
<li><a href="<?= Url::toRoute(['/user/profile/view', 'id' => Yii::$app->user->id], true) ?>" data-hover="PROFILOM">PROFILOM</a></li>
<li><a href="<?= Url::toRoute(['/user/settings'], true) ?>" data-hover="BEÁLLÍTÁSOK">BEÁLLÍTÁSOK</a></li>
<li><a href="<?= Url::toRoute(['/user/logout'], true) ?>" data-hover="KIJELENTKEZÉS">KIJELENTKEZÉS</a></li>