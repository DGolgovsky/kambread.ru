<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Awards;

/**
 * AwardsSearch represents the model behind the search form about `common\models\Awards`.
 */
class AwardsSearch extends Awards
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idawards', 'date'], 'integer'],
            [['general_image', 'description'], 'safe'],
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
        $query = Awards::find();

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
            'idawards' => $this->idawards,
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['like', 'general_image', $this->general_image])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
