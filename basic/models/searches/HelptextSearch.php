<?php

namespace app\models\searches;

use app\models\Helptext;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * HelptextSearch represents the model behind the search form of `\app\models\Helptext`.
 */
class HelptextSearch extends Helptext
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'created', 'updated', 'weight'], 'integer'],
            [['command', 'help', 'decr', 'example', 'parsed', 'source', 'device', 'dop_info'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Helptext::find();

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
            'created' => $this->created,
            'updated' => $this->updated,
            'weight' => $this->weight,
        ]);

        $query->andFilterWhere(['like', 'command', $this->command])
            ->andFilterWhere(['like', 'help', $this->help])
            ->andFilterWhere(['like', 'decr', $this->decr])
            ->andFilterWhere(['like', 'example', $this->example])
            ->andFilterWhere(['like', 'parsed', $this->parsed])
            ->andFilterWhere(['like', 'source', $this->source])
            ->andFilterWhere(['like', 'device', $this->device])
            ->andFilterWhere(['like', 'dop_info', $this->dop_info]);

        return $dataProvider;
    }
}
