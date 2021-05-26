<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%appointment}}`.
 */
class m210521_092139_add_starttime_column_to_appointment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%appointment}}', 'starttime', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%appointment}}', 'starttime');
    }
}
