<?php

namespace common\models;

use Yii;

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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date'], 'integer'],
            [['description'], 'string'],
            [['general_image'], 'string', 'max' => 255],
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
            'general_image' => 'Описание',
            'idawards' => 'ID',
        ];
    }
}
