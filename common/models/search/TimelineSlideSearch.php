<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TimelineSlide;

/**
 * TimelineSlideSearch represents the model behind the search form about `common\models\TimelineSlide`.
 */
class TimelineSlideSearch extends TimelineSlide
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'number', 'width_preset'], 'integer'],
            [['date_1', 'date_2'], 'string'],
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
        $query = TimelineSlide::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'number' => $this->number,
            'width_preset' => $this->width_preset,
        ]);

        $query->andFilterWhere(['like', 'date_1', $this->date_1])
            ->andFilterWhere(['like', 'date_2', $this->date_2]);

        return $dataProvider;
    }
}
