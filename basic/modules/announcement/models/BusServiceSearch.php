<?php

namespace app\modules\announcement\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\announcement\models\BusService;

/**
 * BusServiceSearch represents the model behind the search form about `app\modules\announcement\models\BusService`.
 */
class BusServiceSearch extends BusService
{
	public $department = '';
    public $busStatus;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['title', 'description', 'publishDate', 'image', 'attachment', 'expiryDate', 'dId','busStatus'], 'safe'],
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

        date_default_timezone_set("Asia/Kuala_Lumpur");
        $currentDate = date("Y-m-d");

        $query = BusService::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'sort'=> ['defaultOrder' => ['publishDate' => SORT_DESC]]
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
            'id' => $this->id,
            // 'publishDate' => $this->publishDate,
            // 'expiryDate' => $this->expiryDate,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'publishDate', $this->publishDate])
            ->andFilterWhere(['like', 'expiryDate', $this->expiryDate])
            ->andFilterWhere(['like', 'attachment', $this->attachment])
			->andFilterWhere(['like', 'dId', $this->department])
            ->andFilterWhere(['like', 'dId', $this->dId]);

        if($this->busStatus =='Upcoming'){
            $query->andFilterWhere(['>', 'expiryDate', $currentDate]);
        }else if($this->busStatus =='Archived'){
            $query->andFilterWhere(['<', 'expiryDate', $currentDate]);
        } else if($this->busStatus =='Today'){
            $query->andFilterWhere(['expiryDate' => $currentDate]);
        }

        return $dataProvider;
    }
}
