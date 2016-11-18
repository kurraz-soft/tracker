<?php
/**
 * @var \yii\web\View $this
 */
?>

<?= $this->render('/layouts/_page_header',[
    'header' => Yii::t('admin','Панель управления'),
]) ?>

<!-- Main content -->
<section class="content">
    <!-- Your Page Content Here -->
    <div class="admin-default-index">
        <?= \app\widgets\flash\Flash::widget() ?>
    </div>

</section>
<!-- /.content -->