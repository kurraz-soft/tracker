<?php

namespace app\modules\admin\assets;

use app\modules\admin\vendor\adminlte_asset\AdminLTEAsset;
use yii\web\AssetBundle;
use yii\web\View;

/**
 * Created by PhpStorm.
 * User: Kurraz
 * Date: 16.01.2016
 * Time: 21:24
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot/';
    public $baseUrl = '@web/';
    public $css = [
        //'css/site.css',
    ];
    public $js = [
        'js/admin.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        AdminLTEAsset::class,
    ];

    public $jsOptions = [
        'position' => View::POS_HEAD,
    ];
}