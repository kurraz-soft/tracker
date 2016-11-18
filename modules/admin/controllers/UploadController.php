<?php
/**
 * Created by PhpStorm.
 * User: Kurraz
 * Date: 18.01.2016
 * Time: 15:54
 */

namespace app\modules\admin\controllers;

use app\modules\admin\components\AdminController;
use app\widgets\dropzone\DropzoneUploadAction;
use vova07\imperavi\actions\UploadAction;

class UploadController extends AdminController
{
    public function actions()
    {
        return [
            'editor' => [
                'class' => UploadAction::class,
                'url' => \Yii::getAlias('@web/upload/'),
                'path' => '@webroot/upload',
            ],
            'dropzone' => [
                'class' => DropzoneUploadAction::class,
                'uploadPath' => '@webroot/upload',
            ],
            /*
            'editor-get' => [
                'class' => GetAction::class,
                'url' => \Yii::getAlias('@web/upload/'),
                'path' => '@webroot/upload',
                'type' => GetAction::TYPE_IMAGES,
            ]*/
        ];
    }
}