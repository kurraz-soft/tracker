<?php
/**
 * Created by PhpStorm.
 * User: Kurraz
 * Date: 21.01.2016
 * Time: 8:35
 */

namespace app\models;


use app\components\storage\BaseStorageConnector;
use yii\base\ErrorException;

class Storage
{
    /**
     * @return BaseStorageConnector
     * @throws ErrorException
     */
    static public function getConnector()
    {
        if(!\Yii::$app->storage)
        {
            throw new ErrorException('"storage" component must be set in config file');
        }
        return \Yii::$app->storage;
    }

    static public function save($key, $value = '')
    {
        static::getConnector()->save($key, $value);
    }

    static public function find($key)
    {
        return static::getConnector()->one($key);
    }

    static public function findAll()
    {
        return static::getConnector()->all();
    }

    static public function delete($key)
    {
        return static::getConnector()->delete($key);
    }

    /**
     * Labels for keys
     *
     * Labeled keys cannot be deleted in admin panel
     *
     * @return array
     */
    static public function getKeyLabels()
    {
        return [
            //'g1' => 'тест',
        ];
    }

    static public function renderKey($key)
    {
        $labels = static::getKeyLabels();

        if(isset($labels[$key]))
            return $key . ' ('.$labels[$key].')';

        return $key;
    }
}