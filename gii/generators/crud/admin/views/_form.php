<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

/* @var $model \yii\db\ActiveRecord */
$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}

echo "<?php\n";
?>

use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-form">

    <?= "<?php " ?>$form = ActiveForm::begin(); ?>

<?php foreach ($generator->getColumnNames() as $attribute) {
    if (in_array($attribute, $safeAttributes)) {
        echo "    <?= " . $generator->generateActiveField($attribute) . " ?>\n\n";
    }
} ?>
    <div class="form-group">
        <?= "<?=" ?> Html::submitButton('Сохранить', ['class' => 'btn btn-success', 'name' => 'submit-btn', 'value' => 'save']) <?= "?>\n" ?>
        <?= "<?=" ?> Html::submitButton('Применить', ['class' => 'btn btn-primary', 'name' => 'submit-btn', 'value' => 'apply']) <?= "?>\n" ?>
        <a href="<?= "<?=" ?> Url::to(['index']) <?= "?>" ?>" class="btn btn-default">Отмена</a>
    </div>

    <?= "<?php " ?>ActiveForm::end(); ?>

</div>
