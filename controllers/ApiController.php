<?php

namespace app\controllers;

use app\components\services\ShamanProxyService;
use app\components\exceptions\ApiException;
use app\models\ShamanProxyUser;
use yii\filters\ContentNegotiator;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;

class ApiController extends Controller
{
    public $enableCsrfValidation = false;

    /** @var $shamanProxyService ShamanProxyService */
    protected $shamanProxyService;

    /**
     * Инициализация
     *
     * подключаем сервисы
     */
    public function init()
    {
        parent::init();
        $this->shamanProxyService = \Yii::$app->shamanProxyService;
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::className(),
            'formats' => [
                'application/json' => Response::FORMAT_JSON
            ],
        ];
        $behaviors ['verbs'] = [
            'class' => VerbFilter::className(),
            'actions' => [
                'get-user' => ['post'],
            ],
        ];
        return $behaviors;
    }

    /**
     * Получить информацию пользователя из апи шамана
     *
     * url: api/get-user
     * @return ShamanProxyUser
     */
    public function actionGetUser()
    {
        $this->parseUserParams($email, $password, $curlname);
        $user = $this->shamanProxyService->getShamanUser($email, $password, $curlname);
        return $user;
    }

    /**
     * Получить нужные параметры пользователя из запроса
     * @param $email
     * @param $password
     * @param $curlname
     */
    private function parseUserParams(&$email, &$password, &$curlname)
    {
        $email = $this->parsePostParam('email');
        $password = $this->parsePostParam('password');
        $curlname = $this->parsePostParam('curlname');
    }

    /**
     * Получить параметр из тела запроса
     * @param $paramName
     * @return array|mixed
     * @throws ApiException
     */
    private function parsePostParam($paramName)
    {
        $paramValue = \Yii::$app->request->post($paramName);
        if (null === $paramValue) {
            throw new ApiException(400, "Invalid request. Param with name '$paramName' not set.");
        }
        return $paramValue;
    }

}
