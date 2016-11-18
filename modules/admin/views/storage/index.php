<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/**
 * @var \app\modules\admin\models\StorageForm $model
 * @var \app\components\storage\Record[] $records
 */

$this->title = 'Storage';
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('/layouts/_page_header',[
    'header' => $this->title,
    'breadcrumbs' => $this->params['breadcrumbs'],
]) ?>

<script>
$(function(){
    $('#storage-table').on('keyup','.storage-key',function(){
        var tr = $(this).parents('tr');
        var elVal = $(tr).find('.storage-value');

        console.log(elVal);

        $(elVal).attr('name',$(elVal).data('baseName') + '[' + $(this).val() + ']');

        console.log($(elVal).attr('name'));
    });

    $('#storage-add-row-btn').click(function(e){
        e.preventDefault();

        var row = $('#new-row-template').clone();
        $(row).removeAttr('id').removeClass('hidden').appendTo('#storage-table');
    });
});
</script>

<!-- Main content -->
<section class="content">
    <?php $form = ActiveForm::begin() ?>
    <table class="table table-striped" id="storage-table">
        <tr>
            <th>#</th>
            <th>Key</th>
            <th>Value</th>
            <th></th>
        </tr>
        <tr class="hidden" id="new-row-template">
            <td></td>
            <td>
                <?= Html::textInput('','',[
                    'class' => 'form-control storage-key',
                ]) ?>
            </td>
            <td>
                <?= Html::textInput(Html::getInputName($model,'values').'[]','',[
                    'class' => 'form-control storage-value',
                    'data-base-name' => Html::getInputName($model,'values'),
                ]) ?>
            </td>
        </tr>
        <?php foreach($records as $n => $record): ?>
        <tr>
            <td><?= $n + 1 ?></td>
            <td><?= \app\models\Storage::renderKey($record->key) ?></td>
            <td>
                <?= Html::textInput(Html::getInputName($model,'values').'['.$record->key.']',$record->value,[
                    'class' => 'form-control',
                ]) ?>
            </td>
            <td>
                <?php if(!isset(\app\models\Storage::getKeyLabels()[$record->key])): ?>
                <div class="form-group" style="margin-top: 7px">
                    <?= Html::a('<span class="glyphicon glyphicon-trash"></span>',['delete','key' => $record->key ],['data'=>[
                        'method' => 'post',
                        'confirm' => 'Удалить запись?',
                    ],'title' => 'Удалить']) ?>
                </div>
                <?php endif ?>
            </td>
        </tr>
        <?php endforeach ?>
    </table>

    <div class="row">
        <div class="col-md-2 pull-right">
            <?= Html::button('Добавить запись',['class' => 'btn btn-default','id' => 'storage-add-row-btn']) ?>
        </div>
    </div>


    <p>
        <?= Html::submitButton('Сохранить',['class' => 'btn btn-success']) ?>
    </p>

    <?php ActiveForm::end() ?>
</section>
<!-- /.content -->

