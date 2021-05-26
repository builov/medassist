<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property int $uid
 * @property string|null $lastname
 * @property string|null $firstname
 * @property string|null $patronim
 * @property string|null $birthdate
 * @property int|null $gender
 * @property string|null $insurance_certificate
 * @property string|null $phone
 *
 * @property User $u
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['birthdate'], 'safe'],
            [['gender'], 'integer'],
            [['lastname', 'firstname', 'patronim', 'insurance_certificate', 'phone'], 'string', 'max' => 255],
            [['uid'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['uid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'uid' => 'Uid',
            'lastname' => 'Lastname',
            'firstname' => 'Firstname',
            'patronim' => 'Patronim',
            'birthdate' => 'Birthdate',
            'gender' => 'Gender',
            'insurance_certificate' => 'Insurance Certificate',
            'phone' => 'Phone',
        ];
    }

    /**
     * Gets query for [[U]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getU()
    {
        return $this->hasOne(User::className(), ['id' => 'uid']);
    }
}
