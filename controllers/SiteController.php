<?php

namespace app\controllers;

use app\components\services\LocalProxyService;
use app\models\LoginForm;
use Yii;
use yii\web\Controller;

class SiteController extends Controller
{

    public function actionIndex()
    {
        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $user = $this->getUser($model)) {
            return $this->render('user', ['user' => $user]);
        } else {
            return $this->render('index', ['model' => $model]);
        }
    }

    /**
     * Получить пользователя по апи
     * @param $model LoginForm
     * @return mixed
     */
    private function getUser($model)
    {
        try {
            /** @var $proxyService LocalProxyService */
            $proxyService = \Yii::$app->localProxyService;
            $user = $proxyService->getShamanUser($model->email, $model->password, $model->curlname);
            return $user;
        } catch (\Exception $e) {
            $model->addError('error', $e->getMessage());
        }
    }
}
