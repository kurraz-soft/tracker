<?php
/**
 * @var $header
 * @var $description
 * @var array $breadcrumbs
 */

use yii\helpers\Html;

$description = (isset($description)?$description:'');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?= Html::encode($header) ?>
        <?php if($description): ?>
        <small><?= Html::encode($description) ?></small>
        <?php endif ?>
    </h1>

    <?php if(isset($breadcrumbs)): ?>
        <?= \yii\widgets\Breadcrumbs::widget([
            'homeLink' => [
                'label' => 'Главная',
                'url' => '@adminPanel',
                'template' => "<li><i class=\"fa fa-dashboard\"></i> {link}</li>\n",
            ],
            'itemTemplate' => "<li>{link}</li>\n", // template for all links
            'links' => $breadcrumbs,
        ]); ?>
    <?php endif ?>

    <?/*
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol>*/?>
</section>

<hr>