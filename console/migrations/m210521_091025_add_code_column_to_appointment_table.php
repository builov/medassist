<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%appointment}}`.
 */
class m210521_091025_add_code_column_to_appointment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%appointment}}', 'code', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%appointment}}', 'code');
    }
}
