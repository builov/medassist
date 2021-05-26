<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%complaints}}`.
 */
class m210520_124120_create_complaints_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%complaints}}', [
            'id' => $this->primaryKey(),
            'session' => $this->integer(),
            'code' => $this->integer(),
            'description' => $this->text(),
        ]);

        $this->addForeignKey(
            'fk-complaints-session',
            'complaints',
            'session',
            'session',
            'id',
            'CASCADE'
        );
        $this->createIndex(
            'idx-complaints-session',
            'complaints',
            'session'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-complaints-session',
            'complaints'
        );

        $this->dropIndex(
            'idx-complaints-session',
            'complaints'
        );

        $this->dropTable('{{%complaints}}');
    }
}
