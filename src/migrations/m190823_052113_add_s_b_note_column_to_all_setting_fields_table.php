<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%all_setting_fields}}`.
 */
class m190823_052113_add_s_b_note_column_to_all_setting_fields_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%all_setting_fields}}', 's_note', $this->string(255)->Null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%all_setting_fields}}', 's_note');
    }
}
