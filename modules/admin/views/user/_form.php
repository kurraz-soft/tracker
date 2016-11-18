<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'login')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true, 'value' => '']) ?>

    <?= $form->field($model, 'roles')->widget(\kartik\select2\Select2::class,[
        'data' => \app\models\User::rolesLabels(),
        'options' => [
            'multiple' => true,
            'allowClear' => true,
        ]
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success', 'name' => 'submit-btn', 'value' => 'save']) ?>
        <?= Html::submitButton('Применить', ['class' => 'btn btn-primary', 'name' => 'submit-btn', 'value' => 'apply']) ?>
        <a href="<?= Url::to(['index']) ?>" class="btn btn-default">Отмена</a>
    </div>

    <?php ActiveForm::end(); ?>

</div>
