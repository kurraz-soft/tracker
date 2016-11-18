<?php

namespace app\models;

use Yii;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "product_images".
 *
 * @property integer $id
 * @property integer $product_id
 * @property string $tmp_id
 * @property integer $sort
 * @property string $file
 *
 * @property Products $product
 */
class ProductImages extends \yii\db\ActiveRecord
{
    public $uploadUrl = '/upload';
    public $uploadPath = '@webroot/upload';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_images';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'sort' => 'Sort',
            'file' => 'File',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['id' => 'product_id']);
    }

    public function getPath()
    {
        return $this->uploadUrl . '/' . $this->file;
    }

    static public function getLastSort($parent_id, $tmp_id)
    {
        if($parent_id)
            $where = ['product_id' => $parent_id];
        else
            $where = ['tmp_id' => $parent_id];

        return static::find()->where($where)->max('sort');
    }

    public function beforeDelete()
    {
        //Removing original and thumbnail files
        $files = FileHelper::findFiles(Yii::getAlias($this->uploadPath),['only' => [pathinfo($this->file, PATHINFO_FILENAME).'*']]);

        foreach($files as $file)
        {
            @unlink($file);
        }

        return parent::beforeDelete();
    }
}
