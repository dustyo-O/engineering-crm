<?php
namespace frontend\controllers;

use common\models\Service;
use common\models\ServiceCallType;
use common\models\Subcontractor;
use common\models\SubcontractorFirstAid;
use common\models\SubcontractorOther1Label;
use common\models\SubcontractorOther2Label;
use common\models\SubcontractorOther3Label;
use common\models\SubcontractorPosition;
use common\models\SubcontractorStatus;
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
class SubcontractorController extends Controller
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
        $subcontractor = new Subcontractor();

        $subcontractor_statuses = SubcontractorStatus::find()->all();
        $subcontractor_positions = SubcontractorPosition::find()->all();
        $subcontractor_other1_labels = SubcontractorOther1Label::find()->all();
        $subcontractor_other2_labels = SubcontractorOther2Label::find()->all();
        $subcontractor_other3_labels = SubcontractorOther3Label::find()->all();
        $subcontractor_first_aids = SubcontractorFirstAid::find()->all();

        return $this->render('form', [
            'subcontractor' => $subcontractor,
            'subcontractor_statuses' => $subcontractor_statuses,
            'subcontractor_positions' => $subcontractor_positions,
            'subcontractor_other1_labels' => $subcontractor_other1_labels,
            'subcontractor_other2_labels' => $subcontractor_other2_labels,
            'subcontractor_other3_labels' => $subcontractor_other3_labels,
            'subcontractor_first_aids' => $subcontractor_first_aids
        ]);
    }

    public function actionDelete($id)
    {

    }

    public function actionList()
    {
    }
}
