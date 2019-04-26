<?php

namespace vendor\yii2generalsetting\yii2generalsetting\src\modules\allsettings\models;

use Yii;

/**
 * This is the model class for table "all_setting_fields".
 *
 * @property int $id
 * @property int $s_id
 * @property string $s_label
 * @property string $s_type
 * @property string $s_value
 *
 * @property AllSettings $s
 */
class AllSettingFields extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'all_setting_fields';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['s_id', 's_label'], 'required'],
            [['s_id'], 'integer'],
            [['s_type', 's_value'], 'string'],
            [['s_label'], 'string', 'max' => 255],
            [['s_id'], 'exist', 'skipOnError' => true, 'targetClass' => AllSettings::className(), 'targetAttribute' => ['s_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            's_id' => Yii::t('app', 'S ID'),
            's_label' => Yii::t('app', 'S Label'),
            's_type' => Yii::t('app', 'S Type'),
            's_value' => Yii::t('app', 'S Value'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getS()
    {
        return $this->hasOne(AllSettings::className(), ['id' => 's_id']);
    }
}
