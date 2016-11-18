<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\ProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('/layouts/_page_header',[
    'header' => $this->title,
    'breadcrumbs' => $this->params['breadcrumbs'],
]) ?>

<!-- Main content -->
<section class="content">

    <div class="products-index">

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                //['class' => 'yii\grid\SerialColumn'],

                [
                    'attribute' => 'id',
                    'options' => ['style' => 'width:60px'],
                ],
                [
                    'attribute' => 'active',
                    'format' => 'raw',
                    'value' => function(\app\models\Products $item){
                        return $item->active?'<span class="glyphicon glyphicon-ok text-success"></span>':'<span class="glyphicon glyphicon-remove-circle text-danger"></span>';
                    },
                    'filter' => [
                        1 => 'Да',
                        0 => 'Нет',
                    ],
                    'options' => ['style' => 'width:50px;'],
                    'contentOptions' => ['style' => 'text-align: center'],
                ],
                'name',

                'price',

                ['class' => 'yii\grid\ActionColumn','template' => '{update} {delete}'],
            ],
        ]); ?>

        <p>
            <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

    </div>
</section>
<!-- /.content -->

