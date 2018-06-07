<?php

namespace app\modules\feedback\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\feedback\models\FeedbackResponse;

/**
 * FeedbackResponseSearch represents the model behind the search form about `app\modules\feedback\models\FeedbackResponse`.
 */
class FeedbackResponseSearch extends FeedbackResponse
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['frId', 'fId'], 'integer'],
            [['fResponse', 'frDateTime', 'dId'], 'safe'],
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
        $query = FeedbackResponse::find();

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
            'frId' => $this->frId,
            'frDateTime' => $this->frDateTime,
            'fId' => $this->fId,
        ]);

        $query->andFilterWhere(['like', 'fResponse', $this->fResponse])
            ->andFilterWhere(['like', 'dId', $this->dId]);

        return $dataProvider;
    }
}
