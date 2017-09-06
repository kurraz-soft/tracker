<?php

/**
 * @var $this yii\web\View
 * @var \app\models\TrackerItems[] $items
 * @var \app\models\TrackerCategories $category
 * @var \yii\data\Pagination $pages
 */

if(empty($category))
    $this->title = 'Latest';
else
    $this->title = $category->name;
?>
<div class="container-fluid">

    <section>

        <div class="row" style="text-align: center;">
            <?= \yii\widgets\LinkPager::widget([
                'pagination' => $pages,
            ]) ?>
        </div>

        <div class="row portfolio">

            <?php foreach($items as $item): ?>
            <div class="col-sm-3 col-md-3" style="border: 1px solid; border-collapse: collapse; text-align: center; height: 368px">
                <a href="<?= $item->url ?>" title="<?= $item->name ?>" target="_blank">
                    <div class="box-image">
                        <div class="image">
                            <img style="height: 250px; display: inline" src="<?= $item->image_src ?>" alt="<?= $item->name ?>" class="img-responsive">
                        </div>
                    </div>
                </a>
                <p>
                    <a href="<?= $item->magnet_link ?>" title="Скачать magnet-ссылку"><img src="http://static.t-ru.org/templates/v1/images/icon_magnet_24_1.png"></a>
                </p>
                <!-- /.box-image -->
                <a href="<?= $item->url ?>" title="<?= $item->name ?>" target="_blank">
                    <div class="name" style="color: black; font-size: 12px; font-weight: bold; height: 52px; text-overflow: ellipsis; overflow: hidden">
                        <?= $item->name ?>
                    </div>
                </a>
            </div>
            <?php endforeach ?>

        </div>

        <div class="row" style="text-align: center;">
            <?= \yii\widgets\LinkPager::widget([
                'pagination' => $pages,
            ]) ?>
        </div>

    </section>

</div>
<!-- /.container -->