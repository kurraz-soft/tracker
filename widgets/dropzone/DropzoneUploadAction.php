<?php
/**
 * Created by PhpStorm.
 * User: Kurraz
 * Date: 19.01.2016
 * Time: 10:03
 */

namespace app\widgets\dropzone;


use yii\base\Action;
use yii\base\InvalidConfigException;
use yii\helpers\Json;
use yii\web\BadRequestHttpException;
use yii\web\UploadedFile;

class DropzoneUploadAction extends Action
{
    public $var = 'file';

    /**
     * @var string REQUIRED
     */
    public $uploadPath;

    public function init()
    {
        parent::init();
        if ($this->uploadPath === null) {
            throw new InvalidConfigException('The "uploadPath" attribute must be set.');
        } else {
            $this->uploadPath = \Yii::getAlias(rtrim($this->uploadPath, '/') . '/');
        }
    }

    public function run()
    {
        $this->controller->enableCsrfValidation = false;

        if(!\Yii::$app->request->isPost) throw new BadRequestHttpException();

        if (isset($_FILES[$this->var])) {
            $files = UploadedFile::getInstancesByName($this->var);

            //Print file data
            //print_r($file);

            foreach($files as $file)
            {
                $file->name = uniqid() . '.' . $file->extension;
                if ($file->saveAs($this->uploadPath . '/' . $file->name)) {
                    //Now save file data to database

                    echo Json::encode($file);
                }
            }
        }
    }
}