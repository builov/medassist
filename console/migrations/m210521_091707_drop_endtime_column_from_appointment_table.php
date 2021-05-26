<?php

use yii\db\Migration;

/**
 * Handles dropping columns from table `{{%appointment}}`.
 */
class m210521_091707_drop_endtime_column_from_appointment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%appointment}}', 'endtime');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('{{%appointment}}', 'endtime', $this->integer());
    }
}
