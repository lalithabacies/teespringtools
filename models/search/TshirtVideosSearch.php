<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TshirtVideos;

/**
 * TshirtVideosSearch represents the model behind the search form about `app\models\TshirtVideos`.
 */
class TshirtVideosSearch extends TshirtVideos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['videotitle', 'emdedurl', 'createdon'], 'safe'],
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
        $query = TshirtVideos::find();

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
            'createdon' => $this->createdon,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'videotitle', $this->videotitle])
            ->andFilterWhere(['like', 'emdedurl', $this->emdedurl]);

        return $dataProvider;
    }
}
