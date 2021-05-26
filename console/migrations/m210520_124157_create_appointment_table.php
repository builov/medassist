<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%appointment}}`.
 */
class m210520_124157_create_appointment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%appointment}}', [
            'id' => $this->primaryKey(),
            'doctor' => $this->integer(),
            'patient' => $this->integer(),
            'starttime' => $this->dateTime(),
            'endtime' => $this->dateTime(),
        ]);

        $this->createIndex(
            'idx-appointment-doctor',
            'appointment',
            'doctor'
        );
        $this->createIndex(
            'idx-appointment-patient',
            'appointment',
            'patient'
        );

        $this->addForeignKey(
            'fk-appointment-doctor',
            'appointment',
            'doctor',
            'user',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-appointment-patient',
            'appointment',
            'patient',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex(
            'idx-appointment-doctor',
            'appointment'
        );
        $this->dropIndex(
            'idx-appointment-patient',
            'appointment'
        );
        $this->dropForeignKey(
            'fk-appointment-doctor',
            'appointment'
        );
        $this->dropForeignKey(
            'fk-appointment-patient',
            'appointment'
        );
        $this->dropTable('{{%appointment}}');
    }
}
