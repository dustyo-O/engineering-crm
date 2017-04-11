<?php
namespace frontend\controllers;

use common\models\Service;
use common\models\ServiceCallType;
use Yii;
use yii\base\ErrorException;
use yii\base\InvalidParamException;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\ErrorAction;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Customer controller
 */
class ServiceController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionCreate()
    {
        return $this->actionEdit();
    }

    /**
     * Displays create form for customer.
     *
     * @return mixed
     */
    public function actionEdit($id = null)
    {
        if ($id)
        {
            $service = Service::findOne($id);

            $service->date = (new \DateTime($service->date))->format('d.m.Y');
            $service->time = date('H:i', $service->time);
        }
        else
        {
            $service = new Service();
        }

        $service_info = Yii::$app->request->post("Service");

        if ($service_info) {
            $service->load($service_info, '');

            $service->date = (new \DateTime($service->date))->format('Y-m-d H:i:s');
            $service->time = strtotime($service->time);

            if ($service->save()) {

                Yii::$app->session->setFlash('success', 'Service saved succesfully');
                return $this->redirect(Url::to(['service/list']));
            }
            Yii::$app->session->setFlash('error', 'Error, service was not saved' . json_encode($service->errors));
        }

        $service_call_types = ServiceCallType::find()->all();
        return $this->render('form', [
            'service' => $service,
            'service_call_types' => $service_call_types
        ]);
    }

    public function actionDelete($id)
    {
        if (Service::deleteAll(['id' => $id])) {
            Yii::$app->session->setFlash('success', 'Service removed succesfully');
        } else {
            Yii::$app->session->setFlash('error', 'Error, service was not deleted');
        }

        return $this->redirect(Url::to(['service/list']));
    }

    public function actionList()
    {
        $services = Service::find()->all();

        return $this->render('list', [
            'services' => $services
        ]);
    }

}
