<?php
/**
 * Created by PhpStorm.
 * User: Kurraz
 * Date: 21.01.2016
 * Time: 9:21
 */

namespace app\components\storage;


class Record
{
    public $key;
    public $value;

    function __construct($key, $value)
    {
        $this->key = $key;
        $this->value = $value;
    }
}