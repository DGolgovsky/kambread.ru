<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Product;

/**
 * productSearch represents the model behind the search form about `common\models\product`.
 * @property mixed user_id
 */
class ProductSearch extends Product
{
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['idproduct', 'user_id', 'created_at', 'updated_at'], 'integer'],
			[['new', 'recommend'], 'boolean'],
			[['price', 'weight'], 'double'],
			[['name', 'general_image', 'description', 'type'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function scenarios()
	{
		// bypass scenarios() implementation in the parent class
		return Model::scenarios();
	}

	/**
	 * Creates data provider instance with search query applied
	 *
	 * @param array $params
	 *
	 * @return ActiveDataProvider
	 */
	public function search($params)
	{
		$query = Product::find();

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		$this->load($params);

		if (!$this->validate()) {
			// uncomment the following line if you do not want to return any records when validation fails
			// $query->where('0=1');
			return $dataProvider;
		}

		$query->andFilterWhere([
			'idproduct' => $this->idproduct,
			'price' => $this->price,
			'weight' => $this->weight,
			//'user_id' => $this->user_id,
			'name' => $this->name,
			'new' => $this->new,
			'recommend' => $this->recommend,
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,
		]);

		$query->andFilterWhere(['like', 'general_image', $this->general_image])
			->andFilterWhere(['like', 'description', $this->description])
			->andFilterWhere(['like', 'type', $this->type]);

		return $dataProvider;
	}
}
