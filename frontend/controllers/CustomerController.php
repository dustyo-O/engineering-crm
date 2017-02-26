<?php
namespace frontend\controllers;

use common\models\Customer;
use common\models\CustomerGeneral;
use common\models\CustomerQuote;
use common\models\CustomerStatus;
use common\models\CustomerSystemType;
use common\models\GeneralAccountManager;
use common\models\GeneralMaintenanceContract;
use common\models\GeneralMisc1;
use common\models\GeneralMisc1Label;
use common\models\GeneralMisc2;
use common\models\GeneralMisc2Label;
use common\models\GeneralOtherLabel;
use common\models\GeneralSignallingType;
use common\models\QuoteStatus;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Customer controller
 */
class CustomerController extends Controller
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

    /**
     * Displays create form for customer.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $customer = new Customer();
        $customer_system_types = CustomerSystemType::find()->all();
        $customer_statuses = CustomerStatus::find()->all();

        $customer_quote = new CustomerQuote();
        $quote_statuses = QuoteStatus::find()->all();

        $customer_general = new CustomerGeneral();
        $general_maintenance_contracts = GeneralMaintenanceContract::find()->all();
        $general_signalling_types = GeneralSignallingType::find()->all();
        $general_other_labels = GeneralOtherLabel::find()->all();
        $general_account_managers = GeneralAccountManager::find()->all();
        $general_misc1 = GeneralMisc1::find()->all();
        $general_misc1_labels = GeneralMisc1Label::find()->all();
        $general_misc2 = GeneralMisc2::find()->all();
        $general_misc2_labels = GeneralMisc2Label::find()->all();

        return $this->render('create', [
            'customer' => $customer,
            'customer_system_types' => $customer_system_types,
            'customer_statuses' => $customer_statuses,

            'customer_quote' => $customer_quote,
            'quote_statuses' => $quote_statuses,

            'customer_general' => $customer_general,
            'general_maintenance_contracts' => $general_maintenance_contracts,
            'general_signalling_types' => $general_signalling_types,
            'general_other_labels' => $general_other_labels,
            'general_account_managers' => $general_account_managers,
            'general_misc1' => $general_misc1,
            'general_misc1_labels' => $general_misc1_labels,
            'general_misc2' => $general_misc2,
            'general_misc2_labels' => $general_misc2_labels,
        ]);
    }

}
