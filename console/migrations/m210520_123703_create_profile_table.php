<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%profile}}`.
 */
class m210520_123703_create_profile_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%profile}}', [
            'uid' => $this->primaryKey(),
            'lastname' => $this->string(),
            'firstname' => $this->string(),
            'patronim' => $this->string(),
            'birthdate' => $this->date(),
            'gender' => $this->integer(),
            'insurance_certificate' => $this->string(),
            'phone' => $this->string(),
        ]);

        $this->addForeignKey(
            'fk-profile-uid',
            'profile',
            'uid',
            'user',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-profile-uid',
            'profile',
            'uid'
        );
        $this->createIndex(
            'idx-profile-lastname',
            'profile',
            'lastname'
        );
        $this->createIndex(
            'idx-profile-insurance_certificate',
            'profile',
            'insurance_certificate'
        );
        $this->createIndex(
            'idx-profile-phone',
            'profile',
            'phone'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-profile-uid',
            'profile'
        );

        $this->dropIndex(
            'idx-profile-uid',
            'profile'
        );
        $this->dropIndex(
            'idx-profile-lastname',
            'profile'
        );
        $this->dropIndex(
            'idx-profile-insurance_certificate',
            'profile'
        );
        $this->dropIndex(
            'idx-profile-phone',
            'profile'
        );

        $this->dropTable('{{%profile}}');
    }
}
