<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Awards]].
 *
 * @see Awards
 */
class AwardsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Awards[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Awards|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
