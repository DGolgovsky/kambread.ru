<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Awards]].
 *
 * @see awards
 */
class AwardsQuery extends \yii\db\ActiveQuery
{
    /**
     * @inheritdoc
     * @return awards[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return awards|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
