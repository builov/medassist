<?php


namespace frontend\controllers;

use common\models\Appointment;
use common\models\Complaints;
use common\models\Messages;
use common\models\Profile;
//use common\models\Session;
use frontend\models\ComplaintsForm;
use frontend\models\MessageForm;
use frontend\models\Session;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

/**
 * ChatController
 */
class ChatController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        if (in_array($action->id, ['add-complaint'])) {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }


    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex($code = NULL)
    {
        $session = Yii::$app->session;
        $session->open();

//        echo Yii::$app->session->getId();

        $doctor = Profile::find()->where(['uid' => Yii::$app->user->id])->one();

        //todo если нет данных для этого приема
        $complaints_form = new ComplaintsForm();
        $message_form = new MessageForm();

        if ($code)
        {
            if ($appointment = Appointment::find()->where(['doctor' => Yii::$app->user->id])->andWhere(['code' => $code])->one())
            {
                if ($session = Session::getSession($appointment))
                {
                    return $this->render('index', [
                        'session' => $session,
                        'doctor' => $doctor,
                        'appointment' => $appointment,
                        'complaints_form' => $complaints_form,
                        'message_form' => $message_form,
                    ]);
                }
                else return 'no session';
            }
            else return 'no appointment';
        }
        else return $this->goHome();
    }

    public function actionRefreshComplaints()
    {
        if (Yii::$app->request->isPost)
        {
            $data = Yii::$app->request->post('data');

            $complaints = Complaints::find()->where(['session' => $data[0]])->andWhere(['uid' => Yii::$app->user->id])->all(); //todo добавить явный order
            $response = [];
            foreach ($complaints as $complaint)
            {
                $response['complaints'][] = [$complaint->form_field, $complaint->description, $complaint->id];
            }

            $messages = Messages::find()->where(['session' => $data[0]])->andWhere(['uid' => Yii::$app->user->id])->all(); //todo добавить явный order
            foreach ($messages as $message)
            {
                $response['messages'][] = [$message->id, $message->body, $message->created, $message->phpsessionid];
            }


//            print_r($response);
            return json_encode($response);
        }
    }

    public function actionAddComplaint()
    {
        if (Yii::$app->request->isPost)
        {
            $data = Yii::$app->request->post('data');
//            $data[0] - session
//            $data[1] - doctor
//            $data[2] - patient
//            $data[3] - field_name
//            $data[4] - description

            if ($data[1] == Yii::$app->user->id)
            {
                $model = new Complaints();
                $model->session = $data[0];
                $model->code = '';
                $model->description = $data[4];
                $model->uid = $data[1];
                $model->form_field = $data[3];
                if ($model->save())
                    return Yii::$app->response->statusCode = 200;
            }
            else return Yii::$app->response->statusCode = 403;
        }
    }

    public function actionDeleteComplaint()
    {
        if (Yii::$app->request->isPost)
        {
            $data = Yii::$app->request->post('data');

            if ($data[0] == 'custom')
            {
//                echo $data[1];
                $complaint = Complaints::find()->where(['id' => $data[1]])->andWhere(['uid' => Yii::$app->user->id])->one();
                $complaint->delete();
            }
            else { //todo добавить в Complaints поле parent и при удалении родительской удалять также все дочерние жалобы
                $r = Complaints::find()->where(['session' => $data[0]])->andWhere(['form_field' => $data[3]])->andWhere(['uid' => Yii::$app->user->id])->all();
                foreach ($r as $complaint)
                {
                    $complaint->delete();
                }
            }

        }
    }

    public function actionCreateChatMessage()
    {
        if (Yii::$app->request->isPost)
        {
            $data = Yii::$app->request->post('data');
//            $data[0] - session
//            $data[1] - doctor
//            $data[2] - text

            if ($data[1] == Yii::$app->user->id)
            {
                $model = new Messages();
                $model->session = $data[0];
                $model->uid = $data[1];
                $model->body = $data[2];
                $model->created = time();
                $model->phpsessionid = Yii::$app->session->getId();
                if ($model->save())
                    return Yii::$app->response->statusCode = 200;
            }
            else return Yii::$app->response->statusCode = 403;
        }
    }

    public function actionClearChat()
    {
        if (Yii::$app->request->isPost)
        {
            $data = Yii::$app->request->post('data');
//            $data[0] - session
//            $data[1] - doctor

            if ($data[1] == Yii::$app->user->id)
            {
                $r = Messages::find()->where(['session' => $data[0]])->andWhere(['uid' => Yii::$app->user->id])->all();
                foreach ($r as $message)
                {
                    $message->delete();
                }
                return Yii::$app->response->statusCode = 200;
            }
            else return Yii::$app->response->statusCode = 403;
        }
    }
}

