<?php
/**
 * Created by PhpStorm.
 * User: Kurraz
 * Date: 18.01.2016
 * Time: 18:41
 */

namespace app\assets;


use app\modules\admin\vendor\adminlte_asset\AdminLTEAsset;

class AuthPageAsset extends AdminLTEAsset
{
    public $css = [
        'css/AdminLTE.css',
        'css/skins/skin-blue.min.css',
        'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css',
        'https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css',
        'plugins/iCheck/square/blue.css',
    ];

    public $js = [
        'plugins/iCheck/icheck.min.js',
    ];
}