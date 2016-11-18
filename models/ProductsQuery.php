<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Products]].
 *
 * @see Products
 */
class ProductsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Products[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Products|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function active()
    {
        return $this->andWhere(['active' => true]);
    }


    /**
     * Helper method for easy querying on values containing some common operators.
     *
     * The comparison operator is intelligently determined based on the first few characters in the given value. In particular, it recognizes the following operators if they appear as the leading characters in the given value:
     * <: the column must be less than the given value.
     * >: the column must be greater than the given value.
     * <=: the column must be less than or equal to the given value.
     * >=: the column must be greater than or equal to the given value.
     * <>: the column must not be the same as the given value. Note that when $partialMatch is true, this would mean the value must not be a substring of the column.
     * =: the column must be equal to the given value.
     * none of the above: use the $defaultOperator
     *
     * Note that when the value is empty, no comparison expression will be added to the search condition.
     *
     * @param string $name column name
     * @param string $value column value
     * @param string $defaultOperator Defaults to =, performing an exact match.
     * For example: use 'like' for partial matching
     * @return $this The query object itself
     */
    public function andFilterCompare($name, $value, $defaultOperator = '=')
    {
        $matches=[];
        if (preg_match("/^(<>|>=|>|<=|<|=)/", $value, $matches)) {
            $op = $matches[1];
            $value = substr($value, strlen($op));
        } else {
            $op = $defaultOperator;
        }
        return $this->andFilterWhere([$op, $name, $value]);
    }
}