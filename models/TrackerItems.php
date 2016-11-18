<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tracker_items".
 *
 * @property integer $id
 * @property string $name
 * @property string $url
 * @property string $date
 * @property integer $category_id
 * @property string $image_src
 * @property string $magnet_link
 * @property integer $spider_processed
 *
 * @property TrackerCategories $category
 */
class TrackerItems extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tracker_items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'url'], 'required'],
            [['date'], 'safe'],
            [['category_id', 'spider_processed'], 'integer'],
            [['name', 'url', 'image_src'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'url' => 'Url',
            'date' => 'Date',
            'category_id' => 'Category ID',
            'image_src' => 'Image Src',
            'spider_processed' => 'Spider Processed',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(TrackerCategories::className(), ['id' => 'category_id']);
    }

    /**
     * @inheritdoc
     * @return TrackerItemsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TrackerItemsQuery(get_called_class());
    }
}
