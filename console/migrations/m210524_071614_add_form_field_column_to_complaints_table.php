<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%complaints}}`.
 */
class m210524_071614_add_form_field_column_to_complaints_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%complaints}}', 'form_field', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%complaints}}', 'form_field');
    }
}
