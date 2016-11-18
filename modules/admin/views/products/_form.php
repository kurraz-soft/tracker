<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Products */
?>

<div class="products-form">

    <?php $form = ActiveForm::begin(); ?>

    <input type="hidden" class="hash-input" name="hash">

    <div class="nav-tabs-custom">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home-tab" aria-controls="home" role="tab" data-toggle="tab">Основные</a></li>
            <li role="presentation"><a href="#gallery-tab" aria-controls="profile" role="tab" data-toggle="tab">Фото</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home-tab">
                <?= $form->field($model, 'active')->radioList([1 => 'Активно',0 => 'Не активно'],['inline' => true]) ?>

                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'text_preview')->textarea(['rows' => 6]) ?>

                <?=  $form->field($model, 'text_detail')->widget(\vova07\imperavi\Widget::class,[
                    'settings' => [
                        'lang' => 'ru',
                        'minHeight' => 200,
                        'imageUpload' => Url::to(['upload-images']),
                        //'imageManagerJson' => Url::to(['upload/editor-get']),
                        'plugins' => [
                            'clips',
                            'fullscreen',
                            'imagemanager',
                        ],
                    ]
                ]) ?>

                <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
            </div>
            <div role="tabpanel" class="tab-pane" id="gallery-tab">
                <h2>Gallery</h2>
                <div id="gallery"
                     data-url="<?= Url::to(['get-gallery','parent_id' => (int)$model->id, 'tmp_id' => $model->tmp_id]) ?>"
                     data-sort-url="<?= Url::to(['image-sort']) ?>"
                >
                    <?php $images = $model->isNewRecord?$model->getNewProductImages():$model->productImages ?>
                    <?php if($images): ?>
                        <?= $this->render('_gallery',['images' => $images]) ?>
                    <?php endif ?>
                </div>

                <?= $form->field($model, 'imagesSort')->hiddenInput(['id' => 'gallery-sort-value'])->label(false) ?>

                <div class="row">
                    <div class="col-md-6" style="min-height: 354px">
                        <div class="form-group">
                            <?= \kartik\widgets\FileInput::widget([
                                'name' => 'file[]',
                                'options' => [ 'multiple' => true ],
                                'pluginOptions' => [
                                    'allowedFileTypes' => [
                                        'image',
                                    ],
                                    'showPreview' => true,
                                    'showCaption' => true,
                                    'uploadUrl' => Url::to(['upload-images']),
                                    'uploadExtraData' => [
                                        'parent_id' => (int)$model->id,
                                        'tmp_id' => $model->tmp_id,
                                    ],
                                ],
                                'pluginEvents' => [
                                    'filebatchuploadcomplete' => 'KzGallery.fileBatchUploadComplete',
                                    'filebatchselected' => 'KzGallery.fileLoaded',
                                ]
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => 'btn btn-success', 'name' => 'submit-btn', 'value' => 'save']) ?>
        <?= Html::submitButton('Применить', ['class' => 'btn btn-primary', 'name' => 'submit-btn', 'value' => 'apply']) ?>
        <a href="<?= Url::to(['index']) ?>" class="btn btn-default">Отмена</a>
    </div>

    <?php ActiveForm::end(); ?>

</div>
