<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tracker_categories".
 *
 * @property integer $id
 * @property string $name
 *
 * @property TrackerItems[] $trackerItems
 */
class TrackerCategories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tracker_categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255]
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrackerItems()
    {
        return $this->hasMany(TrackerItems::className(), ['category_id' => 'id']);
    }
}
