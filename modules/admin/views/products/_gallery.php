<?php
/**
 * @var \app\models\ProductImages[] $images
 */
use yii\helpers\Url;
?>
<div class="container-fluid">
    <p class="badge badge-inverse">Передвигайте блоки чтобы отсортировать в нужном порядке</p>
    <div class="row gallery-sortable">
        <?php foreach($images as $img): ?>
            <div class="col-md-1 gallery-item" data-id="<?= $img->id ?>">
                <a href="<?= $img->getPath() ?>" class="thumbnail">
                    <img src="<?= \app\components\ThumbImage::make($img->getPath(),['w' => 200, 'h' => 200]) ?>" class="img-responsive">
                    <div>
                        &nbsp;
                        <button title="Удалить" type="button" class="close gallery-delete-btn" data-url="<?= Url::to(['image-delete','id' => $img->id]) ?>" aria-label="Close">
                            <span aria-hidden="true">&nbsp;&nbsp;&times;</span>
                        </button>
                    </div>
                </a>
            </div>
        <?php endforeach ?>
    </div>
</div>