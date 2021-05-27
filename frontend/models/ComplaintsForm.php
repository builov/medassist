<?php


namespace frontend\models;


use common\models\Profile;
use yii\base\Model;

class ComplaintsForm extends Model
{
    public $complaint1;
    public $complaint2;
    public $complaint3;
    public $complaint4;
    public $complaint5;
    public $complaint6;
    public $complaint7;
    public $complaint8;
    public $complaint9;
    public $complaint10;
    public $complaint11;
    public $complaint11_1;
    public $complaint11_2;
    public $complaint11_3;
    public $complaint11_4;
    public $complaint12;
    public $complaint12_1;
    public $complaint12_2;
    public $complaint12_3;
    public $complaint13;
    public $complaint14;
    public $complaint14_1;
    public $complaint14_2;
    public $complaint15;
    public $complaint16;
    public $complaint17;
    public $complaint18;
    public $complaint19;
    public $complaint20;
    public $complaint21;

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'complaint1' =>  'Головная боль',
            'complaint2' =>  'Боли за грудиной',
            'complaint3' =>  'Ощущение сердцебиения',
            'complaint4' =>  'Перебои сердечного ритма',
            'complaint5' =>  'Отеки',
            'complaint6' =>  'Одышка',
            'complaint7' =>  'Кашель',
            'complaint8' =>  'Боли в животе',
            'complaint9' =>  'Тошнота, рвота',
            'complaint10' =>  'Диарея',
            'complaint11' =>  'Боли в пояснице',
            'complaint11_1' =>  'Тупая боль в области поясницы',
            'complaint11_2' =>  'Острая боль в области поясницы',
            'complaint11_3' =>  'Иной характер боли в пояснице',
            'complaint11_4' =>  'Иррадиирующая боль',
            'complaint12' =>  'Учащенное мочеиспускание',
            'complaint12_1' =>  'Частота мочеиспускания до 10 раз в сутки',
            'complaint12_2' =>  'Частота мочеиспускания от 10 до 15 раз в сутки',
            'complaint12_3' =>  'Иная частота мочеиспускания',
            'complaint13' =>  'Рези в конце мочеиспускания',
            'complaint14' =>  'Повышение температуры',
            'complaint14_1' =>  'Температура тела: 37,3-37,9',
            'complaint14_2' =>  'Температура тела: >38,0',
            'complaint15' =>  'Жажда',
            'complaint16' =>  'Нарушение чувствительности',
            'complaint17' =>  'Ограничение движений',
            'complaint18' =>  'Зуд',
            'complaint19' =>  'Ухудшение слуха',
            'complaint20' =>  'Иное:',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[
                'complaint1',
                'complaint2',
                'complaint3',
                'complaint4',
                'complaint5',
                'complaint6',
                'complaint7',
                'complaint8',
                'complaint9',
                'complaint10',
                'complaint11',
                'complaint11_1',
                'complaint11_2',
                'complaint11_3',
                'complaint11_4',
                'complaint12',
                'complaint12_1',
                'complaint12_2',
                'complaint12_3',
                'complaint13',
                'complaint14',
                'complaint14_1',
                'complaint14_2',
                'complaint15',
                'complaint16',
                'complaint17',
                'complaint18',
                'complaint19'
            ], 'integer'],
            [[
                'complaint20'
            ], 'string'],
        ];
    }
}