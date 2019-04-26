<?php

namespace vendor\yii2generalsetting\yii2generalsetting\src\modules\allsettings\models;

use Yii;

/**
 * This is the model class for table "setting_saved".
 *
 * @property int $id
 * @property int $f_id
 * @property string $value
 *
 * @property AllSettingFields $f
 */
class SettingSaved extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'setting_saved';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['f_id', 'value'], 'required'],
            [['f_id'], 'integer'],
            [['value'], 'string'],
            [['f_id'], 'exist', 'skipOnError' => true, 'targetClass' => AllSettingFields::className(), 'targetAttribute' => ['f_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'f_id' => Yii::t('app', 'F ID'),
            'value' => Yii::t('app', 'Value'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getF()
    {
        return $this->hasOne(AllSettingFields::className(), ['id' => 'f_id']);
    }
}
