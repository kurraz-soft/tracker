<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Products */

$title = 'Products';
$this->title = 'Добавить ' . $title;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('/layouts/_page_header',[
    'header' => $title,
    'description' => 'Новая запись',
    'breadcrumbs' => $this->params['breadcrumbs'],
]) ?>

<!-- Main content -->
<section class="content">

    <div class="products-create">

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    </div>

</section>