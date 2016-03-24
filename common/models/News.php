<?php

namespace common\models;

use frontend\components\Common;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "news".
 *
 * @property integer $idnews
 * @property integer $user_id
 * @property string $name
 * @property string $general_image
 * @property string $description
 * @property integer $created_at
 * @property integer $updated_at
 **/

class News extends \yii\db\ActiveRecord
{
    public static $dates = ['updated_at', 'created_at'];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className()
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['news'] = ['general_image'];

        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'filter', 'filter' => 'trim'],
            ['name', 'required'],
            ['name', 'string', 'min' => 2, 'max' => 48],

            ['user_id', 'integer'],
            ['idnews', 'unique', 'targetClass' => '\common\models\News', 'message' => 'ID не уникален.'],

            ['description', 'filter', 'filter' => 'trim'],
            ['description', 'string'],
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
            'idnews' => 'ID новости',
            'name' => 'Наименование',            
            'user_id' => 'ID пользователя',
            'general_image' => 'Главное изображение',
            'description' => 'Описание',            
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
            'user.name' => 'Добавлено',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(),['id' => 'user_id']);
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
        Yii::$app->locator->cache->set('id', $this->idnews);
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