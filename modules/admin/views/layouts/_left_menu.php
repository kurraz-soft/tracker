<?php
/**
 * @var \yii\web\View $this
 */

use yii\helpers\Html;
use yii\helpers\Url;
?>
<ul class="sidebar-menu">
    <li class="header"><?= Yii::t('admin','КОНТЕНТ') ?></li>

    <li class="<?= Yii::$app->controller->id == 'products'?'active':'' ?>"><a href="<?= Url::to('/admin/products/index') ?>"><i class="fa fa-book"></i> <span>Каталог</span></a></li>
    <li class="<?= Yii::$app->controller->id == 'storage'?'active':'' ?>"><a href="<?= Url::to('/admin/storage/index') ?>"><i class="fa fa-archive"></i> <span>Хранилище</span></a></li>
    <?php if(Yii::$app->user->can(\app\models\User::ROLE_ADMIN)): ?>
        <li class="<?= Yii::$app->controller->id == 'user'?'active':'' ?>"><a href="<?= Url::to('/admin/user/index') ?>"><i class="glyphicon glyphicon-user"></i> <span>Пользователи</span></a></li>
    <?php endif ?>

    <?/*
    <!-- Optionally, you can add icons to the links -->
    <li class=""><a href="#"><i class="fa fa-link"></i> <span>Link</span></a></li>
    <li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li>
    <li class="treeview">
        <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
            <li><a href="#">Link in level 2</a></li>
            <li><a href="#">Link in level 2</a></li>
        </ul>
    </li>*/?>
</ul>