<?php

namespace app\models;

use Yii;
use yii\base\Event;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "products".
 *
 * @property integer $id
 * @property integer $active
 * @property string $name
 * @property string $text_preview
 * @property string $text_detail
 * @property string $price
 * @property string $imagesSort
 *
 * @property ProductImages[] $productImages
 */
class Products extends \yii\db\ActiveRecord
{
    public $tmp_id;
    public $_images_sort;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['active'], 'integer'],
            [['name'], 'required'],
            [['text_preview', 'text_detail', 'imagesSort'], 'string'],
            [['price'], 'number'],
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
            'active' => 'Активность',
            'name' => 'Наименование',
            'text_preview' => 'Превью',
            'text_detail' => 'Описание',
            'price' => 'Цена',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductImages()
    {
        return $this->hasMany(ProductImages::className(), ['product_id' => 'id'])->orderBy('sort');
    }

    public function getNewProductImages()
    {
        return ProductImages::find()->where(['product_id' => null, 'tmp_id' => $this->tmp_id])->all();
    }

    /**
     * @inheritdoc
     * @return ProductsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductsQuery(get_called_class());
    }

    /**
     * Getter for virtual property imagesSort
     */
    public function getImagesSort()
    {
        return implode(',', ArrayHelper::getColumn($this->productImages,'id'));
    }

    /**
     * Setter for virtual property imagesSort
     *
     * @param $value
     */
    public function setImagesSort($value)
    {
        $this->_images_sort = $value;
    }

    public function init()
    {
        parent::init();

        $this->tmp_id = Yii::$app->user->id;

        $this->on(static::EVENT_AFTER_INSERT,function(Event $event){
            ProductImages::updateAll(['product_id' => $this->id],['tmp_id' => $this->tmp_id]);
        });
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if($this->imagesSort == $this->_images_sort) return true;

        $sort_arr = array_flip(explode(',',$this->_images_sort));

        foreach($this->productImages as $img)
        {
            $img->sort = $sort_arr[$img->id];
            $img->save();
        }
    }
}
