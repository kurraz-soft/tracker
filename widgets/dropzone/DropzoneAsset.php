<?php
/**
 * Created by PhpStorm.
 * User: Kurraz
 * Date: 19.01.2016
 * Time: 10:13
 */

namespace app\widgets\dropzone;


use yii\web\AssetBundle;
use yii\web\View;

class DropzoneAsset extends AssetBundle
{
    public $sourcePath = __DIR__.'/assets';

    public $js = [
        'dropzone.js',
    ];

    public $css = [
        'dropzone.css',
    ];

    public $jsOptions = [
        'position' => View::POS_HEAD,
    ];
}