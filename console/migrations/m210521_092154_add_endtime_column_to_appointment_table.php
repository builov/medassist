<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%appointment}}`.
 */
class m210521_092154_add_endtime_column_to_appointment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%appointment}}', 'endtime', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%appointment}}', 'endtime');
    }
}
