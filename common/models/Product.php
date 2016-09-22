<?php

namespace common\models;

use frontend\components\Common;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "product".
 *
 * @property integer $idproduct
 * @property double $price
 * @property double $weight
 * @property integer $user_id
 * @property string $name
 * @property string $s_name
 * @property string $general_image
 * @property string $description
 * @property boolean $new
 * @property string $type
 * @property boolean $recommend
 * @property boolean $status
 * @property integer $created_at
 * @property integer $updated_at
 **/
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
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
            [['price', 's_name', 'name', 'weight'], 'required'],
            [['idproduct', 'user_id'], 'integer'],
            [['price', 'weight'], 'double'],
            [['status', 'new', 'recommend'], 'boolean'],
            [['description', 'name', 'type'], 'string'],
            [['s_name'], 'string', 'max' => 30],
            ['idproduct', 'unique', 'targetClass' => '\common\models\Product', 'message' => 'ID не уникален.'],
            //['general_image', 'file', 'extensions' => ['jpg','png','gif']]
        ];
    }

    public function getTitle()
    {
        return Common::getTitle($this);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idproduct' => 'ID продукта',
            'name' => 'Наименование',
            's_name' => 'Краткое наименование',
            'price' => 'Цена',
            'weight' => 'Вес',
            'user_id' => 'ID пользователя',
            'general_image' => 'Главное изображение',
            'description' => 'Описание',
            'new' => 'Новинка',
            'type' => 'Тип',
            'recommend' => 'Рекомендация',
            'status' => 'Опубликовано',
            'created_at' => 'Создано',
            'updated_at' => 'Изменено',
            'user.name' => 'Пользователь',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    //beforeValidate
    //afterValidate
    //beforeSave
    //afterSave
    //beforeFind
    //afterFind

    public function afterValidate()
    {
        $this->user_id = Yii::$app->user->identity->id;
    }

    public function afterSave($insert, $changedAttributes)
    {
        Yii::$app->locator->cache->set('id', $this->idproduct);
    }

    /**
     * @inheritdoc
     * @return ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductQuery(get_called_class());
    }
}
