<?php

/* @var $this \yii\base\View */

use yii\helpers\Url;

?>

<li><a href="<?= Url::toRoute(['/'], true) ?>" data-hover="ÜZENŐFAL">ÜZENŐFAL</a></li>
<li><a href="<?= Url::toRoute(['/label/view'], true) ?>" data-hover="KATEGÓRIÁK">KATEGÓRIÁK</a></li>
<li><a href="<?= Url::toRoute(['/user/login'], true) ?>" data-hover="BELÉPÉS">BELÉPÉS</a></li>
<li><a href="<?= Url::toRoute(['/user/register'], true) ?>" data-hover="REGISZTRÁCIÓ">REGISZTRÁCIÓ</a></li>