<?php

use yii\db\Migration;

/**
 * Handles dropping columns from table `{{%appointment}}`.
 */
class m210521_091650_drop_starttime_column_from_appointment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%appointment}}', 'starttime');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('{{%appointment}}', 'starttime', $this->integer());
    }
}
