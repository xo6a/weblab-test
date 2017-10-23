<?php

namespace app\components\managers;

use app\models\ShamanProxyUser;

/**
 * Класс управления пользователями
 * @package app\components\managers
 */
class ShamanProxyUserManager
{
    /**
     * Функция лего позволит вынести общие методы менеджеров в родительский абстракный класс
     * @return string
     */
    public function getModelClass()
    {
        return ShamanProxyUser::class;
    }

    /**
     * Получить экземпляр класса из массива данных
     * @param $userInfo array
     * @return ShamanProxyUser
     * @throws \Exception
     */
    public function getShamanProxyUser($userInfo)
    {
        @$user = new ShamanProxyUser($userInfo);
        if (!$user) {
            throw new \Exception("Can't load 'Shaman Proxy User'");
        } else {
            return $user;
        }
    }

}