<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%complaints}}`.
 */
class m210524_071600_add_uid_column_to_complaints_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%complaints}}', 'uid', $this->integer());

        $this->addForeignKey(
            'fk-complaints-uid',
            'complaints',
            'uid',
            'user',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-complaints-uid',
            'complaints',
            'uid'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%complaints}}', 'uid');

        $this->dropForeignKey(
            'fk-complaints-uid',
            'complaints'
        );

        $this->dropIndex(
            'idx-complaints-uid',
            'complaints'
        );
    }
}
