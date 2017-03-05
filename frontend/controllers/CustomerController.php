<?php
namespace frontend\controllers;

use common\models\Customer;
use common\models\CustomerGeneral;
use common\models\CustomerQuote;
use common\models\CustomerStatus;
use common\models\CustomerSystemType;
use common\models\GeneralAccountManager;
use common\models\GeneralDocuments;
use common\models\GeneralMaintenanceContract;
use common\models\GeneralMisc1;
use common\models\GeneralMisc1Label;
use common\models\GeneralMisc2;
use common\models\GeneralMisc2Label;
use common\models\GeneralOtherLabel;
use common\models\GeneralSignallingType;
use common\models\QuoteDocuments;
use common\models\QuoteStatus;
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
            $customer = Customer::findOne($id);
            $customer_quote = CustomerQuote::find()->where(['id' => $customer->quote_id])->with('documents')->one();
            $customer_general = CustomerGeneral::findOne($customer->general_id);

            $customer_general->start_date = (new \DateTime($customer_general->start_date))->format('d.m.Y');
        }
        else
        {
            $customer = new Customer();
            $customer_quote = new CustomerQuote();
            $customer_general = new CustomerGeneral();

        }

        $customer_general_info = Yii::$app->request->post("CustomerGeneral");
        $customer_quote_info = Yii::$app->request->post("CustomerQuote");
        $customer_info = Yii::$app->request->post("Customer");

        if ($customer_general_info && $customer_quote_info && $customer_info)
        {
            $customer_general->load($customer_general_info, '');
            $customer_general->start_date = (new \DateTime($customer_general->start_date))->format('Y-m-d H:i:s');
            if ($customer_general->save())
            {
                $customer_quote->load($customer_quote_info, '');
                if ($customer_quote->save())
                {
                    $customer->load($customer_info, '');
                    $customer->quote_id = $customer_quote->id;
                    $customer->general_id = $customer_general->id;

                    if ($customer->save())
                    {
                        $documents = Yii::$app->request->post("QuoteDocuments");

                        if ($documents)
                        {
                            foreach ($documents as $document)
                            {
                                $quote_document = new QuoteDocuments();

                                $quote_document->document_id = $document['id'];
                                $quote_document->quote_id = $customer_quote->id;

                                $quote_document->save();
                            }
                        }

                        $documents = Yii::$app->request->post("GeneralDocuments");

                        if ($documents)
                        {
                            foreach ($documents as $document)
                            {
                                $general_document = new GeneralDocuments();

                                $general_document->document_id = $document['id'];
                                $general_document->general_id = $customer_general->id;

                                $general_document->save();
                            }

                        }


                        Yii::$app->session->setFlash('success', 'Customer saved succesfully');
                        return $this->redirect(Url::to(['customer/list']));
                    }
                    else
                    {
                        $customer_quote->delete();
                        $customer_general->delete();
                    }
                }
                else
                {
                    $customer_general->delete();
                }
            }
            Yii::$app->session->setFlash('error', 'Error, customer was not saved');
        }

        $customer_system_types = CustomerSystemType::find()->all();
        $customer_statuses = CustomerStatus::find()->all();

        $quote_statuses = QuoteStatus::find()->all();

        $general_maintenance_contracts = GeneralMaintenanceContract::find()->all();
        $general_signalling_types = GeneralSignallingType::find()->all();
        $general_other_labels = GeneralOtherLabel::find()->all();
        $general_account_managers = GeneralAccountManager::find()->all();
        $general_misc1 = GeneralMisc1::find()->all();
        $general_misc1_labels = GeneralMisc1Label::find()->all();
        $general_misc2 = GeneralMisc2::find()->all();
        $general_misc2_labels = GeneralMisc2Label::find()->all();

        return $this->render('form', [
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

    public function actionDelete($id)
    {
        $customer = Customer::findOne($id);

        if(!$customer)
        {
            throw new ErrorException('Customer does not exists');
        }
        else
        {
            if ($customer->delete())
            {
                Yii::$app->session->setFlash('success', 'Customer deleted succesfully');
                return $this->redirect(Url::to(['customer/list']));
            }
            else
            {
                Yii::$app->session->setFlash('error', 'Error, customer was not deleted');
                return $this->redirect(Url::to(['customer/edit', 'id' => $customer->id]));
            }
        }
    }

    public function actionList()
    {
        $customers = Customer::find()->with('quote')->with('general')->with('customerStatus')->all();

        return $this->render('list', [
            'customers' => $customers
        ]);
    }

}
