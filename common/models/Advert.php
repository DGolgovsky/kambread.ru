<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "advert".
 *
 * @property integer $idadvert
 * @property integer $price
 * @property string $address
 * @property integer $fk_agent
 * @property integer $bedroom
 * @property integer $livingroom
 * @property integer $parking
 * @property integer $kitchen
 * @property string $general_image
 * @property string $description
 * @property string $location
 * @property integer $hot
 * @property integer $sold
 * @property string $type
 * @property integer $recommend
 * @property integer $created_at
 * @property integer $updated_at
**/

class Advert extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'advert';
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
		$scenarios['step2'] = ['general_image'];

		return $scenarios;
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['price', 'location'], 'required'],
			[['price', 'fk_agent', 'bedroom', 'livingroom', 'parking', 'kitchen', 'hot', 'sold', 'type', 'recommend'], 'integer'],
			[['description'], 'string'],
			[['address'], 'string', 'max' => 255],
			[['location'], 'string', 'max' => 50],
			//['general_image', 'file', 'extensions' => ['jpg','png','gif']]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'idadvert' => 'Idadvert',
			'price' => 'Цена',
			'address' => 'Адрес',
			'fk_agent' => 'ID пользователя',
			'bedroom' => 'Спальни',
			'livingroom' => 'Комнаты',
			'parking' => 'Парковка',
			'kitchen' => 'Кухни',
			'general_image' => 'Главное изображение',
			'description' => 'Описание',
			'location' => 'Локация',
			'hot' => 'Новинка',
			'sold' => 'Старинка',
			'type' => 'Тип',
			'recommend' => 'Рекомендация',
			'created_at' => 'Создано',
			'updated_at' => 'Изменено',
		];
	}

	public function getUser()
	{
		return $this->hasOne(User::className(),['id' => 'fk_agent']);
	}

	//beforeValidate
	//afterValidate
	//beforeSave
	//afterSave
	//beforeFind
	//afterFind

	public function afterValidate()
	{
		$this->fk_agent = Yii::$app->user->identity->id;
	}

	public function afterSave($insert, $changedAttributes)
	{
		Yii::$app->locator->cache->set('id', $this->idadvert);
	}

	/**
	 * @inheritdoc
	 * @return AdvertQuery the active query used by this AR class.
	 */
	public static function find()
	{
		return new AdvertQuery(get_called_class());
	}
}