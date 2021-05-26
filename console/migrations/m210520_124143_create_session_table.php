<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%session}}`.
 */
class m210520_124143_create_session_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%session}}', [
            'id' => $this->primaryKey(),
            'doctor' => $this->integer(),
            'patient' => $this->integer(),
            'appointment' => $this->integer(),
            'started' => $this->integer(),
            'ended' => $this->integer(),
        ]);

        $this->addForeignKey(
            'fk-session-doctor',
            'session',
            'doctor',
            'user',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-session-patient',
            'session',
            'patient',
            'user',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-session-appointment',
            'session',
            'appointment',
            'appointment',
            'id',
            'CASCADE'
        );
        $this->createIndex(
            'idx-session-doctor',
            'session',
            'doctor'
        );
        $this->createIndex(
            'idx-session-patient',
            'session',
            'patient'
        );
        $this->createIndex(
            'idx-session-appointment',
            'session',
            'appointment'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-session-doctor',
            'session'
        );
        $this->dropForeignKey(
            'fk-session-patient',
            'session'
        );
        $this->dropForeignKey(
            'fk-session-appointment',
            'session'
        );
        $this->dropIndex(
            'idx-session-doctor',
            'session'
        );
        $this->dropIndex(
            'idx-session-patient',
            'session'
        );
        $this->dropIndex(
            'idx-session-appointment',
            'session'
        );

        $this->dropTable('{{%session}}');
    }
}
