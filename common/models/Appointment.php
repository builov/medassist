<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "appointment".
 *
 * @property int $id
 * @property int|null $doctor
 * @property int|null $patient
 * @property string|null $starttime
 * @property string|null $endtime
 * @property string|null $code
 *
 * @property User $doctor0
 * @property User $patient0
 * @property Session[] $sessions
 */
class Appointment extends \yii\db\ActiveRecord
{

    //todo добавить индекс на поле code

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appointment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['doctor', 'patient'], 'integer'],
            [['starttime', 'endtime'], 'safe'],
            [['code'], 'string', 'max' => 255],
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
            'starttime' => 'Starttime',
            'endtime' => 'Endtime',
            'code' => 'Code',
        ];
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

    /**
     * Gets query for [[Sessions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSessions()
    {
        return $this->hasMany(Session::className(), ['appointment' => 'id']);
    }
}
