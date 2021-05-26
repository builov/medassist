<?php


namespace frontend\models;


use yii\base\Model;

class MessageForm extends Model
{
    public $message;

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'message' =>  'Сообщение',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['message'], 'string'],
        ];
    }
}