<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tests;

/**
 * TestsSearch represents the model behind the search form about `app\models\Tests`.
 */
class TestsSearch extends Tests
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id','is_premium', 'has_gift'], 'integer'],
            [['name', 'description','user_id', 'analyse', 'main_file', 'images'], 'safe'],
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
        $query = Tests::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinwith(['testItems','category','user']);
        
        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'is_premium' => $this->is_premium,
            'has_gift' => $this->has_gift,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'user.fio', $this->user_id])
            ->andFilterWhere(['like', 'analyse', $this->analyse])
            ->andFilterWhere(['like', 'main_file', $this->main_file])
            ->andFilterWhere(['like', 'images', $this->images]);

        return $dataProvider;
    }
}
