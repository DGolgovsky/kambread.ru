<?php

namespace common\models;

use frontend\components\Common;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "product".
 *
 * @property integer $idproduct
 * @property integer $price
 * @property string $address
 * @property integer $fk_agent
 * @property string $name
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
			[['price', 'fk_agent', 'livingroom', 'parking', 'kitchen', 'hot', 'sold', 'recommend'], 'integer'],
			[['description', 'name', 'type'], 'string'],
			[['address'], 'string', 'max' => 255],
			[['location'], 'string', 'max' => 50],
			//['general_image', 'file', 'extensions' => ['jpg','png','gif']]
		];
	}

	public function getTitle()
	{
		return Common::getTitleProduct($this);
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'idproduct' => 'ID продукта',
			'name' => 'Наименование',
			'price' => 'Цена',
			'address' => 'Адрес',
			'fk_agent' => 'ID пользователя',
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
			'user.name' => 'Добавлено',
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