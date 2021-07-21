<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TestItems;

/**
 * TestItemsSearch represents the model behind the search form about `app\models\TestItems`.
 */
class TestItemsSearch extends TestItems
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'test_id', 'count'], 'integer'],
            [['name', 'answers'], 'safe'],
            [['ball'], 'number'],
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
        $query = TestItems::find();

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
            'id' => $this->id,
            'test_id' => $this->test_id,
            'count' => $this->count,
            'ball' => $this->ball,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'answers', $this->answers]);

        return $dataProvider;
    }
}
