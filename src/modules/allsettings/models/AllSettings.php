<?php

namespace vendor\yii2generalsetting\yii2generalsetting\src\modules\allsettings\models;

use Yii;

/**
 * This is the model class for table "all_settings".
 *
 * @property int $id
 * @property string $title
 * @property string $icon
 *
 * @property AllSettingFields[] $allSettingFields
 */
class AllSettings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'all_settings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['icon'], 'string'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'icon' => Yii::t('app', 'Icon'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAllSettingFields()
    {
        return $this->hasMany(AllSettingFields::className(), ['s_id' => 'id']);
    }
}
