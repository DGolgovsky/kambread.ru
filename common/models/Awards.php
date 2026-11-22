<?php

namespace common\models;

use Yii;
use frontend\components\Common;

/**
 * This is the model class for table "awards".
 *
 * @property integer $date
 * @property string $description
 * @property string $general_image
 * @property integer $idawards
 */
class Awards extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'awards';
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['addimg'] = ['general_image'];

        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'idawards'], 'integer'],
            [['description'], 'string'],
            [['general_image'], 'string', 'max' => 255],
            ['idawards', 'unique', 'targetClass' => '\common\models\Awards', 'message' => 'ID не уникален.'],

            ['description', 'filter', 'filter' => 'trim'],
            ['description', 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'date' => 'Дата',
            'description' => 'Описание',
            'general_image' => 'Изображение',
            'idawards' => 'ID',
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        Yii::$app->locator->cache->set('id', $this->idawards);
    }

    public static function find()
    {
        return new AwardsQuery(get_called_class());
    }
}
