<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('/layouts/_page_header',[
'header' => $this->title,
'breadcrumbs' => $this->params['breadcrumbs'],
]) ?>
<!-- Main content -->
<section class="content">

    <div class="user-index">

            <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                    //['class' => 'yii\grid\SerialColumn'],

                [
                    'attribute' => 'id',
                    'options' => ['style' => 'width:60px'],
                ],
                'name',
                'login',
                [
                    'attribute' => 'roles',
                    'value' => function($item){
                        return implode(', ', $item->rolesLabels);
                    },
                    //'filter' => \app\models\User::rolesLabels(),
                    'filter' => false,
                ],
                //'password',

                    ['class' => 'yii\grid\ActionColumn','template' => '{update} {delete}'],
                ],
            ]); ?>
    
        <p>
            <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

    </div>
</section>
<!-- /.content -->

