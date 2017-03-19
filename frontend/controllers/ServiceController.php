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
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
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
        $service_call_types = ServiceCallType::find()->all();
        $service = new Service();
        return $this->render('form', [
            'service' => $service,
            'service_call_types' => $service_call_types
        ]);
    }

    public function actionDelete($id)
    {

    }

    public function actionList()
    {
    }

}
