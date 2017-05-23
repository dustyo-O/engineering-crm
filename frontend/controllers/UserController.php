<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\ErrorAction;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\ResetPasswordForm;

/**
 * User controller
 */
class UserController extends Controller
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

    public function beforeAction($action) {
        if (parent::beforeAction($action)) {
            // change layout for error action
            if ($action->id=='error') $this->layout = 'error';
            return true;
        } else {
            return false;
        }
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        $this->layout = 'login.php';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionChangePassword()
    {
        $model = new ResetPasswordForm();

        if ($data = \Yii::$app->request->post()) {
            $model->load($data);

            if ($model->resetPassword()) {
                Yii::$app->session->setFlash('success', 'Password changed succesfully');
            } else {
                Yii::$app->session->setFlash('error', 'Error, password was not changed');
            }

            return $this->redirect(Url::to(['site/index']));
        }

        return $this->render('change-password', [
            'model' => $model
        ]);
    }
}
