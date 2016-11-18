<?php
/**
 * Created by
 * User: Kurraz
 * Date: 18.01.2015
 */

namespace app\components;

class MyFileHelper
{
    static public function download($url)
    {
        $filename = \Yii::getAlias('@upload').'/'.end(explode('/',$url));
        $file = @file_get_contents($url);
        if(!$file) return false;
        file_put_contents($filename,$file);
        return end(explode('/',$url));
    }

    static public function getPath($filename, $from_webroot = true)
    {
        if($from_webroot)
        {
            return \Yii::getAlias('@upload_web/'.$filename);
        }
        return \Yii::getAlias('@upload/'.$filename);
    }
} 