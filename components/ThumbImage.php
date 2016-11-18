<?php
/**
 * User: KurrazSoft
 * Date: 26.03.13
 */
namespace app\components;

use yii\base\ErrorException;

require_once(\Yii::getAlias('@vendor/cornernote/phpthumb/phpthumb/phpthumb.class.php'));

class ThumbImage
{
    static function make ($src, $params = "") {
        if (file_exists($_SERVER['DOCUMENT_ROOT'].$src)) {
            $ext = pathinfo($_SERVER['DOCUMENT_ROOT'].$src, PATHINFO_EXTENSION);
            $base_name = basename($src, ".".$ext);
            if (!defined("MAKEIMAGE_CODE_GEN_FUNCTION")) define ("MAKEIMAGE_CODE_GEN_FUNCTION", false);
            switch (MAKEIMAGE_CODE_GEN_FUNCTION) { // filesize || md5_file
                case "filesize": $code = md5(serialize($params).filesize($_SERVER['DOCUMENT_ROOT'].$src)); break;
                case "md5_file": $code = md5(serialize($params).md5_file($_SERVER['DOCUMENT_ROOT'].$src)); break;
                default: $code = md5(serialize($params).$_SERVER['DOCUMENT_ROOT'].$src);
            }
            $thumb_file = dirname($src)."/".$base_name."_thumb_".$code.".".$ext;
            if (file_exists($_SERVER['DOCUMENT_ROOT'].$thumb_file)) {
                return $thumb_file;
            } else {
                $phpThumb = new \phpThumb();
                $phpThumb->src = $src;
                switch (strtolower($ext)) {
                    case "jpg": $phpThumb->f = "jpeg"; break;
                    case "gif": $phpThumb->f = "gif"; break;
                    case "png": $phpThumb->f = "png"; break;
                    default: $phpThumb->f = "jpeg"; break;
                }
                $phpThumb->q = 80;
                //$phpThumb->bg = "ffffff";
                $phpThumb->bg = "000000";
                $phpThumb->far = "C";
                $phpThumb->aoe = 0;
                $phpThumb->config_document_root = $_SERVER['DOCUMENT_ROOT'];
                if (is_array($params)) {
                    foreach ($params as $param=>$value) {
                        $phpThumb->$param = $value;
                    }
                }
                $phpThumb->GenerateThumbnail();
                $success = $phpThumb->RenderToFile($_SERVER['DOCUMENT_ROOT'].$thumb_file);
                if ($success) return $thumb_file;
                else throw new ErrorException('Cant generate thumb');
            }
        } else {
            //throw new ErrorException('source not found');
            return 'http://placehold.it/100x100?text=image+not+found';
        }
    }
}
