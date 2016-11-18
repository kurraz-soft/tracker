<?php
/**
 * Created by PhpStorm.
 * User: Kurraz
 * Date: 21.01.2016
 * Time: 8:53
 */

namespace app\components\storage;


use yii\base\Component;

abstract class BaseStorageConnector extends Component
{
    abstract public function one($key);
    abstract public function all();
    abstract public function delete($key);
    abstract public function save($key,$value);
}