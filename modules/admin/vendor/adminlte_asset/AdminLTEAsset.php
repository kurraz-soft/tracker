<?php
/**
 * Created by PhpStorm.
 * User: Kurraz
 * Date: 18.01.2016
 * Time: 11:07
 */

namespace app\modules\admin\vendor\adminlte_asset;


use yii\web\AssetBundle;
use yii\web\View;

class AdminLTEAsset extends AssetBundle
{
    public $sourcePath = __DIR__.'/dist';
    public $sourceImgPath = __DIR__.'/img';

    public $css = [
        'css/AdminLTE.css',
        'css/skins/skin-blue.min.css',
        'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css',
        'https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css',
    ];

    public $js = [
        'js/app.js',
        'plugins/html.sortable.src.js',
        'plugins/jquery.hideseek.js',
        'js/KzGallery.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];

    public $jsOptions = [
        'position' => View::POS_HEAD,
    ];

    protected static $imgPath;

    public function init()
    {
        parent::init();

        $ret = \Yii::$app->assetManager->publish($this->sourceImgPath);
        static::$imgPath = $ret[1];
    }

    public static function img($filename)
    {
        return static::$imgPath .'/'. $filename;
    }
}