<?php


namespace app\components;


use yii\helpers\Url;

class LocalProxyFile
{
    static public function makeUrl($url)
    {
        return Url::to(['proxy/file', 'url' => base64_encode($url)]);
    }

    static public function isImageLinkNotBroken($img_url)
    {
        if(empty($img_url)) return false;

        list($width, $height, $type, $attr) = @getimagesize($img_url);
        if(!$height || !$width)
            $img_url = null;

        return !!$img_url;
    }
}