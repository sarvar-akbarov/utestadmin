<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Results;

/**
 * ResultsSearch represents the model behind the search form about `app\models\Results`.
 */
class ResultsSearch extends Results
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'student_id', 'test_id', 'test_item_id'], 'integer'],
            [['answers'], 'safe'],
            [['point'], 'number'],
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
        $query = Results::find();

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
            'student_id' => $this->student_id,
            'test_id' => $this->test_id,
            'test_item_id' => $this->test_item_id,
            'point' => $this->point,
        ]);

        $query->andFilterWhere(['like', 'answers', $this->answers]);

        return $dataProvider;
    }
}
