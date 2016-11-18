<?php
/**
 * Created by PhpStorm.
 * User: Kurraz
 * Date: 20.01.2016
 * Time: 22:29
 */

namespace app\components\storage\bdb;


use app\components\storage\BaseStorageConnector;
use app\components\storage\Record;

class BerkeleyDbConnector extends BaseStorageConnector
{
    public $path = '@runtime/bdb/base.db';
    public $handler = 'db4';

    protected $dbPath;

    function __construct($config = [])
    {
        parent::__construct($config);

        $this->dbPath = \Yii::getAlias($this->path);
    }

    /**
     * @param $key
     * @return Record
     */
    public function one($key)
    {
        $value = null;

        $db = dba_open($this->dbPath,'c',$this->handler);

        if(dba_exists($key,$db))
        {
            $value = dba_fetch($key, $db);
        }

        dba_close($db);

        return new Record($key, $value);
    }

    /**
     * @return Record[]
     */
    public function all()
    {
        \Yii::beginProfile('Read all data from BDB');

        $db = dba_open($this->dbPath,'c',$this->handler);

        $key = dba_firstkey($db);

        $ret = [];

        while ($key != false)
        {
            $ret[] = new Record($key, dba_fetch($key, $db));
            $key = dba_nextkey($db);
        }
        dba_close($db);

        \Yii::endProfile('Read all data from BDB');

        return $ret;
    }

    /**
     * @param $key
     * @return bool
     */
    public function delete($key)
    {
        $db = dba_open($this->dbPath,'c',$this->handler);
        dba_delete($key, $db);
        dba_close($db);

        return true;
    }

    /**
     * @param $key
     * @param $value
     * @return bool
     */
    public function save($key, $value)
    {
        $db = dba_open($this->dbPath,'c',$this->handler);
        dba_replace($key, $value, $db);
        dba_close($db);

        return true;
    }
}