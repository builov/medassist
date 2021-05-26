<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "complaints".
 *
 * @property int $id
 * @property int|null $session
 * @property int|null $code
 * @property string|null $description
 * @property int|null $uid              //владелец записи, имеет право на удаление (врач).
 * @property string|null $form_field
 *
 * @property Session $session0
 * @property User $u
 */
class Complaints extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'complaints';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['session', 'code', 'uid'], 'integer'],
            [['description'], 'string'],
            [['form_field'], 'string', 'max' => 255],
            [['session'], 'exist', 'skipOnError' => true, 'targetClass' => Session::className(), 'targetAttribute' => ['session' => 'id']],
            [['uid'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['uid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'session' => 'Session',
            'code' => 'Code',
            'description' => 'Description',
            'uid' => 'Uid',
            'form_field' => 'Form Field',
        ];
    }

    /**
     * Gets query for [[Session0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSession0()
    {
        return $this->hasOne(Session::className(), ['id' => 'session']);
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
