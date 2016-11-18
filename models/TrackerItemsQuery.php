<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[TrackerItems]].
 *
 * @see TrackerItems
 */
class TrackerItemsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return TrackerItems[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TrackerItems|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function active()
    {
        return $this->andWhere(['spider_processed' => 1]);
    }
}