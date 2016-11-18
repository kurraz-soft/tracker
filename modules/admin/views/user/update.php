<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$title = 'User: ' . ' ' . $model->name;
$this->title = 'Редактирование '.$title;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<?= $this->render('/layouts/_page_header',[
'header' => $title,
'description' => 'Редактирование',
'breadcrumbs' => $this->params['breadcrumbs'],
]) ?>
<!-- Main content -->
<section class="content">

    <div class="user-update">

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    </div>

</section>