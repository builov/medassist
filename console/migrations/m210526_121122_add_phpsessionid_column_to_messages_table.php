<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%messages}}`.
 */
class m210526_121122_add_phpsessionid_column_to_messages_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%messages}}', 'phpsessionid', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%messages}}', 'phpsessionid');
    }
}
