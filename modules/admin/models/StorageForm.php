<?php
/**
 * Created by PhpStorm.
 * User: Kurraz
 * Date: 21.01.2016
 * Time: 10:09
 */

namespace app\modules\admin\models;


use app\models\Storage;
use yii\base\Model;

class StorageForm extends Model
{
    public $values;

    public function rules()
    {
        return [
            [['values'],'safe'],
        ];
    }

    public function save()
    {
        foreach($this->values as $key => $value)
        {
            if($key)
                Storage::save($key, $value);
        }
    }
}