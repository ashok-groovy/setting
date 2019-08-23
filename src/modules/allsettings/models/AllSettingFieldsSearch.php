<?php

namespace vendor\yii2generalsetting\yii2generalsetting\src\modules\allsettings\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use vendor\yii2generalsetting\yii2generalsetting\src\modules\allsettings\models\AllSettingFields;

/**
 * AllSettingFieldsSearch represents the model behind the search form of `vendor\yii2generalsetting\yii2generalsetting\modules\allsettings\models\AllSettingFields`.
 */
class AllSettingFieldsSearch extends AllSettingFields
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 's_id'], 'integer'],
            [['s_type', 's_value','s_note'], 'safe'],
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
        $query = AllSettingFields::find()->where(["s_id"=>$_GET['sid']]);;

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
            's_id' => $this->s_id,
        ]);

        $query->andFilterWhere(['like', 's_type', $this->s_type])
            ->andFilterWhere(['like', 's_value', $this->s_value]);

        return $dataProvider;
    }
}
