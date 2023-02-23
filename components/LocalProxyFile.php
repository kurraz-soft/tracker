<?php


namespace app\components;


use yii\helpers\Url;

class LocalProxyFile
{
    static public function makeUrl($url)
    {
        return Url::to(['proxy/file', 'url' => base64_encode($url)]);
    }
}