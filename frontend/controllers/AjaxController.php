<?php
namespace frontend\controllers;

use Yii;
use yii\base\ErrorException;
use yii\base\InvalidParamException;
use yii\base\Response;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
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
        return [];
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
                throw new ErrorException('Не удалось сохранить данные');
            }
        }

        throw new ErrorException('Неправильный запрос');
    }

}
