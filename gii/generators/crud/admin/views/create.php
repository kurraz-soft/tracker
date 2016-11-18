<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

echo "<?php\n";
?>

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

$title = <?= $generator->generateString('{modelClass}', ['modelClass' => Inflector::camel2words(StringHelper::basename($generator->modelClass))]) ?>;
$this->title = 'Добавить ' . $title;
$this->params['breadcrumbs'][] = ['label' => <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= '<?=' ?> $this->render('/layouts/_page_header',[
'header' => $title,
'description' => 'Новая запись',
'breadcrumbs' => $this->params['breadcrumbs'],
]) <?= '?>' ?>

<!-- Main content -->
<section class="content">

    <div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-create">

        <?= "<?= " ?>$this->render('_form', [
            'model' => $model,
        ]) ?>

    </div>

</section>