<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%messages}}`.
 */
class m210520_124209_create_messages_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%messages}}', [
            'id' => $this->primaryKey(),
            'uid' => $this->integer(),
            'session' => $this->integer(),
            'body' => $this->text(),
            'created' => $this->integer(),
        ]);

        $this->addForeignKey(
            'fk-messages-uid',
            'messages',
            'uid',
            'user',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-messages-session',
            'messages',
            'session',
            'session',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-messages-uid',
            'messages',
            'uid'
        );
        $this->createIndex(
            'idx-messages-session',
            'messages',
            'session'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-messages-uid',
            'messages'
        );
        $this->dropForeignKey(
            'fk-messages-session',
            'messages'
        );
        $this->dropIndex(
            'idx-messages-uid',
            'messages'
        );
        $this->dropIndex(
            'idx-messages-session',
            'messages'
        );
        $this->dropTable('{{%messages}}');
    }
}
