<?php


namespace app\controllers;


use app\components\Controller;

class ProxyController extends Controller
{
    public function actionFile($url)
    {
        $cache = \Yii::$app->cache;

        $file = $cache->getOrSet($url, function () use ($url){

            $arrContextOptions=array(
                "ssl"=>array(
                    "verify_peer"=>false,
                    "verify_peer_name"=>false,
                ),
            );

            $context = stream_context_create($arrContextOptions);

            return file_get_contents(base64_decode($url), false, $context);
        });

        return $file;
    }
}