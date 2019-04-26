<?php

namespace vendor\yii2generalsetting\yii2generalsetting\src\modules\allsettings\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use vendor\yii2generalsetting\yii2generalsetting\src\modules\allsettings\models\AllSettings;

/**
 * AllSettingsSearch represents the model behind the search form of `vendor\yii2generalsetting\yii2generalsetting\modules\allsettings\models\AllSettings`.
 */
class AllSettingsSearch extends AllSettings
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['title', 'icon'], 'safe'],
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
        $query = AllSettings::find();

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
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'icon', $this->icon]);

        return $dataProvider;
    }
}
