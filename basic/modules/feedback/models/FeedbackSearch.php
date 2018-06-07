<?php

namespace app\modules\feedback\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\feedback\models\Feedback;

/**
 * FeedbackSearch represents the model behind the search form about `app\modules\feedback\models\Feedback`.
 */
class FeedbackSearch extends Feedback
{
	public $department = '';
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fId', 'fType'], 'integer'],
            [['uId', 'dId', 'fStatus', 'fType', 'fContent', 'fAttachment'], 'safe'],
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
        $query = Feedback::find()->leftJoin('user', 'feedback.uId = user.uId');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'sort'=> ['defaultOrder' => ['fId' => SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
		
		if (Yii::$app->user->identity->dsResponsibility !== 'Super Admin') {
			$this->department = Yii::$app->user->identity->dId;
		}

        // grid filtering conditions
        $query->andFilterWhere([
            'fType' => $this->fType,
            'fStatus' => $this->fStatus,
        ]);

        $query->andFilterWhere(['like', 'user.uName', $this->uId])
			->andFilterWhere(['like', 'user.uEmail', $this->fContent])
			->andFilterWhere(['like', 'user.uPhone', $this->fAttachment])
			->andFilterWhere(['like', 'dId', $this->department])
            ->andFilterWhere(['like', 'dId', $this->dId]);

        return $dataProvider;
    }
}
