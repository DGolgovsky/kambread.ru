<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[product]].
 *
 * @see product
 */
class ProductQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return product[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return product|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
