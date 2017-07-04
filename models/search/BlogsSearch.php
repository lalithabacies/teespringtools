<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Blogs;

/**
 * BlogsSearch represents the model behind the search form about `app\models\Blogs`.
 */
class BlogsSearch extends Blogs
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'createdby', 'modifiedby'], 'integer'],
            [['blogname', 'blogdescription', 'blogimage', 'createddate', 'modifieddate', 'status'], 'safe'],
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
        $query = Blogs::find();

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
            'createddate' => $this->createddate,
            'createdby' => $this->createdby,
            'modifieddate' => $this->modifieddate,
            'modifiedby' => $this->modifiedby,
        ]);

        $query->andFilterWhere(['like', 'blogname', $this->blogname])
            ->andFilterWhere(['like', 'blogdescription', $this->blogdescription])
            ->andFilterWhere(['like', 'blogimage', $this->blogimage])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
