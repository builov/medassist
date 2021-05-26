<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "session".
 *
 * @property int $id
 * @property int|null $doctor
 * @property int|null $patient
 * @property int|null $appointment
 * @property int|null $started
 * @property int|null $ended
 *
 * @property Complaints[] $complaints
 * @property Messages[] $messages
 * @property Appointment $appointment0
 * @property User $doctor0
 * @property User $patient0
 */
class Session extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'session';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['doctor', 'patient', 'appointment', 'started', 'ended'], 'integer'],
            [['appointment'], 'exist', 'skipOnError' => true, 'targetClass' => Appointment::className(), 'targetAttribute' => ['appointment' => 'id']],
            [['doctor'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['doctor' => 'id']],
            [['patient'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['patient' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'doctor' => 'Doctor',
            'patient' => 'Patient',
            'appointment' => 'Appointment',
            'started' => 'Started',
            'ended' => 'Ended',
        ];
    }

    /**
     * Gets query for [[Complaints]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComplaints()
    {
        return $this->hasMany(Complaints::className(), ['session' => 'id']);
    }

    /**
     * Gets query for [[Messages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Messages::className(), ['session' => 'id']);
    }

    /**
     * Gets query for [[Appointment0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAppointment0()
    {
        return $this->hasOne(Appointment::className(), ['id' => 'appointment']);
    }

    /**
     * Gets query for [[Doctor0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDoctor0()
    {
        return $this->hasOne(User::className(), ['id' => 'doctor']);
    }

    /**
     * Gets query for [[Patient0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPatient0()
    {
        return $this->hasOne(User::className(), ['id' => 'patient']);
    }

    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['uid' => 'patient']);
    }
}
