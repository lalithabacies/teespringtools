<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Domain;


/**
 * DomainSearch represents the model behind the search form about `app\models\Domain`.
 */
class DomainSearch extends Domain
{
	public $applink;
	
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'userid', 'status'], 'integer'],
            [['name', 'description', 'date','applink'], 'safe'],
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
        $query = Domain::find()->where(['retarget_domain.userid'=>Yii::$app->user->id])->orderBy('retarget_domain.id DESC');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

		$query->joinWith(['appDetails as app']);
		$query->joinWith(['appDetails.mapDetails as map']);
       
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'userid' => $this->userid,
            'status' => $this->status,
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
			->andFilterWhere(['like', 'applink', $this->applink])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
