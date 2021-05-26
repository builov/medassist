<?php


namespace frontend\models;

use Yii;

class Session extends \common\models\Session
{
    public static function getSession($appointment)
    {
        if ($appointment)
        {
            if (!$session = \common\models\Session::find()->where(['appointment' => $appointment->id])->one())
            {
                $session = new Session();
                $session->doctor = $appointment->doctor;
                $session->patient = $appointment->patient;
                $session->appointment = $appointment->id;
                $session->started = time();
                $session->save();
            }

//            print_r($session);

            return $session;
        }
        return false;
    }
}