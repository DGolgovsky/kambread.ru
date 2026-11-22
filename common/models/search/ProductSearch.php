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
            [['new', 'recommend', 'status'], 'boolean'],
            [['price', 'weight'], 'double'],
            [['name', 's_name', 'general_image', 'description', 'type'], 'safe'],
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
            //'name' => $this->name,
            //'s_name' => $this->s_name,
            'new' => $this->new,
            'recommend' => $this->recommend,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'general_image', $this->general_image])
            ->andFilterWhere(['ilike', 'description', $this->description])
            ->andFilterWhere(['ilike', 'type', $this->type])
            ->andFilterWhere(['ilike', 'name', $this->name])
            ->andFilterWhere(['ilike', 's_name', $this->s_name]);

        return $dataProvider;
    }
}
