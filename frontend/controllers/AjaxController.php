<?php
namespace frontend\controllers;

use common\models\Documents;
use Yii;
use yii\base\ErrorException;
use yii\base\InvalidParamException;
use yii\base\Response;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\ErrorAction;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Ajax controller
 */
class AjaxController extends Controller
{
    /**
     * @inheritdoc
     */
    public function __construct($id, $module, array $config = [])
    {
        parent::__construct($id, $module, $config);

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    }

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
            ]
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
     * Universal method adding rows to simple models (inputs with pluses).
     *
     * @return mixed
     */
    public function actionModelAdd()
    {
        $model_param = Yii::$app->request->post('name', null);
        $title = Yii::$app->request->post('title', null);

        if ($model_param && $title)
        {
            $model_name = 'common\\models\\' . str_replace(' ', '', ucwords(str_replace('_', ' ', $model_param)));

            $model = new $model_name();
            $model->title = $title;

            if ($model->save())
            {
                return [
                    'status' => 'ok',
                    'id' => $model->id
                ];
            }
            else
            {
                throw new ErrorException('Saving failed');
            }
        }

        throw new ErrorException('Not enough data');
    }

    /**
     * Uploads Document and saves the record to db
     * @return array Document Info
     * @throws ErrorException Upload Errors
     */
    public function actionDocumentUpload()
    {
        $document = new Documents();
        $uploaded_file = UploadedFile::getInstance($document,'file');

        if ($document->uploadDocument($uploaded_file))
        {
            if ($document->save())
            {
                $response = $document->toArray();
                return $response;
            }
            else
            {
                $document->clean();
                throw new ErrorException('Database fail');
            }
        }
        else
        {
            throw new ErrorException('Upload failed');
        }

    }


    /**
     * Removes Document and deletes the record to db
     * @return array Result Info
     * @throws ErrorException remove Errors
     */
    public function actionDocumentRemove()
    {
        $id = Yii::$app->request->post('id', null);

        $document = Documents::findOne($id);

        if ($document)
        {
            if ($document->delete())
            {
                return ['status' => 'ok'];
            }
            else
            {
                throw new ErrorException('File deletion failed');
            }
        }
        else
        {
            throw new ErrorException('Document does not exists');
        }
    }
}
