<?php

namespace app\components\services;

class LocalProxyService extends BasicProxyService
{
    /**
     * Получить пользователя шамана через апи запрос
     * @param $email
     * @param $password
     * @param $curlname
     * @return \app\models\ShamanProxyUser
     */
    public function getShamanUser($email, $password, $curlname)
    {
        $userInfo = $this->getResponseShamanUser($email, $password, $curlname);
        $user = $this->shamanProxyUserManager->getShamanProxyUser($userInfo);
        return $user;
    }

    /**
     * Получить ответ от апи сервера по запросу авторизации
     *
     * request: api/get-user
     * @param $email
     * @param $password
     * @param $curlname
     * @return mixed
     * @throws \Exception
     */
    private function getResponseShamanUser($email, $password, $curlname)
    {
        return $this->sendCurl(
            'post',
            'api/get-user', [
            'email' => $email,
            'password' => $password,
            'curlname' => $curlname,
        ]);
    }

}