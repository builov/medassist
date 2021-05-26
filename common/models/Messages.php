<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "messages".
 *
 * @property int $id
 * @property int|null $uid
 * @property int|null $session
 * @property string|null $body
 * @property int|null $created
 *
 * @property Session $session0
 * @property User $u
 */
class Messages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'messages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['uid', 'session', 'created'], 'integer'],
            [['body'], 'string'],
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
            'uid' => 'Uid',
            'session' => 'Session',
            'body' => 'Body',
            'created' => 'Created',
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
