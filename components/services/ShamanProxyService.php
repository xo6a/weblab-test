<?php

namespace app\components\services;

use app\models\ShamanProxyUser;

class ShamanProxyService extends BasicProxyService
{
    /**
     * Получить полный url до сайта Шамана
     * @param string $path
     * @return string
     */
    public function getUrl($path = '')
    {
        return \Yii::$app->params['shamanUrl'] . $path;
    }

    /**
     * Получить пользователя шамана по его данным
     * @param $email
     * @param $password
     * @param $curlname
     * @return ShamanProxyUser
     */
    public function getShamanUser($email, $password, $curlname)
    {
        $token = $this->getShamanUserToken($email, $password, $curlname);
        $user = $this->getShamanUserData($token);
        return $user;
    }

    /**
     * Получить токен пользователя шамана
     * @param $email
     * @param $password
     * @param $curlname
     * @return mixed
     * @throws \Exception
     */
    private function getShamanUserToken($email, $password, $curlname)
    {
        $response = $this->getResponseShamanToken($email, $password, $curlname);
        @$token = $response['token'];
        if (!$token)
            throw new \Exception("Can't get shaman user token.");
        return $token;
    }

    /**
     * Получить ответ от шамана по запросу авторизации
     *
     * request: auth/login
     *
     * test data:
     * 'email' => 'test@user.demo',
     * 'password' => '1234567A',
     * 'curlname' => 'web-2015',
     * @param $email
     * @param $password
     * @param $curlname
     * @return mixed
     * @throws \Exception
     */
    private function getResponseShamanToken($email, $password, $curlname)
    {
        return $this->sendCurl(
            'post',
            'auth/login',
            [
                'email' => $email,
                'password' => $password,
                'curlname' => $curlname,
            ]
        );
    }

    /**
     * Получить пользователя шамана по токену
     * @param $token
     * @return ShamanProxyUser
     */
    private function getShamanUserData($token)
    {
        $userInfo = $this->getResponseUserInfo($token);
        $userInfo['token'] = $token;
        $user = $this->shamanProxyUserManager->getShamanProxyUser($userInfo);
        return $user;
    }

    /**
     * Получить ответ от шамана по запросу информации пользователя
     *
     * request: user/current
     * @param $token
     * @return mixed
     * @throws \Exception
     */
    private function getResponseUserInfo($token)
    {
        return $this->sendCurl(
            'get',
            'user/current',
            [],
            ["Authorization: $token"]
        );
    }

    /**
     * @inheritdoc
     */
    protected function parseErrorMessages()
    {
        if ($this->curl->responseCode == 500)
            throw new \Exception('Ошибка на стороне сервера шаман.');

        if (!isset($this->curl->response['message']))
            return self::ERROR_MSG_INVALID_RESPONSE_DATA;

        if (!is_array($this->curl->response['message']))
            return $this->curl->response['message'];

        $errorMessages = [];
        foreach ($this->curl->response['message'] as $message) {
            $errorMessages[] = $message;
        }
        if (!$errorMessages)
            return self::ERROR_MSG_INVALID_RESPONSE_DATA;
        else
            return implode(' ', $errorMessages);
    }

}