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
 * @property string $general_image
 * @property string $description
 * @property integer $new
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
		$scenarios['addimg'] = ['general_image'];

		return $scenarios;
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['price', 'name', 'weight'], 'required'],
			[['user_id', 'new', 'recommend'], 'integer'],
			[['price', 'weight'], 'double'],
			[['description', 'name', 'type'], 'string'],
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
			'price' => 'Цена',
			'weight' => 'Вес',
			'user_id' => 'ID пользователя',
			'general_image' => 'Главное изображение',
			'description' => 'Описание',
			'new' => 'Новинка',
			'type' => 'Тип',
			'recommend' => 'Рекомендация',
			'created_at' => 'Создано',
			'updated_at' => 'Изменено',
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