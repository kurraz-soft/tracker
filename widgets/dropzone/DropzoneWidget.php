<?php
/**
 * Created by PhpStorm.
 * User: Kurraz
 * Date: 19.01.2016
 * Time: 10:02
 */

namespace app\widgets\dropzone;


use yii\base\Widget;

class DropzoneWidget extends Widget
{
    public $uploadRoute;

    public function init()
    {
        parent::init();
        DropzoneAsset::register($this->getView());
    }

    public function run()
    {
        return $this->render('default',[
            'id' => $this->id,
            'uploadRoute' => $this->uploadRoute,
        ]);
    }
}