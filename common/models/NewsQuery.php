<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[news]].
 *
 * @see news
 */
class NewsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return news[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return news|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
