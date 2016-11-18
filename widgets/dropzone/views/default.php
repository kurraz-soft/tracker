<?php
/**
 * @var \yii\web\View $this
 * @var $uploadRoute
 * @var $id
 */
use yii\helpers\Url;
?>

<form action="<?= Url::to($uploadRoute) ?>" id="<?= $id ?>" class="dropzone"></form>