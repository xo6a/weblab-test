<?php

namespace app\components\services;

use app\components\managers\ShamanProxyUserManager;
use linslin\yii2\curl\Curl;

abstract class BasicProxyService
{
    const ERROR_MSG_INVALID_RESPONSE_DATA = 'Invalid response data';

    /** @var Curl */
    protected $curl;
    /** @var ShamanProxyUserManager */
    protected $shamanProxyUserManager;


    public function __construct()
    {
        $this->initCurl();
        $this->initShamanProxyUserManager();
    }

    /**
     * Настройка curl сервиса
     */
    protected function initCurl()
    {
        $this->curl = new Curl();
        $this->curl->setOption(
            CURLOPT_RETURNTRANSFER,
            1
        );
    }

    /**
     * Инициализация менеджера пользователей шамана
     */
    protected function initShamanProxyUserManager()
    {
        $this->shamanProxyUserManager = \Yii::$app->shamanProxyUserManager;
    }

    /**
     * Получить полный url до сайта
     * @param string $path
     * @return string
     */
    protected function getUrl($path = '')
    {
        return \Yii::$app->request->hostInfo . '/' . $path;
    }

    /**
     * Отправка curl запроса
     * @param $method string [get|post]
     * @param $path string url
     * @param $postFields array post параметры
     * @param $headers array заголовки
     * @return mixed
     * @throws \Exception
     */
    protected function sendCurl($method = 'get', $path = '', $postFields = [], $headers = [])
    {
        if ($headers)
            $this->curl->setOption(
                CURLOPT_HTTPHEADER,
                $headers
            );
        if ($postFields)
            $this->curl->setOption(
                CURLOPT_POSTFIELDS,
                http_build_query($postFields)
            );
        switch ($method) {
            case 'get':
                $result = $this->curl->get($this->getUrl($path));
                break;
            case 'post':
                $result = $this->curl->post($this->getUrl($path));
                break;
            default:
                throw new \Exception("Http method '$method' not supported.");
        }
        return $this->getCurlResponse($result);
    }

    /**
     * Получить ответ curl запроса
     * @param $result boolean
     * @return mixed
     * @throws \Exception
     */
    protected function getCurlResponse($result)
    {
        $this->prepareCurlResponse();
        if (!$result || $this->curl->responseCode != 200) {
            $errorMessages = $this->parseErrorMessages();
            throw new \Exception($errorMessages);
        }
        return $this->curl->response;
    }

    /**
     * Преобразовать ответ curl запроса
     * @uses $this->curl->response
     * @return mixed
     * @throws \Exception
     */
    protected function prepareCurlResponse()
    {
        $this->curl->response = json_decode($this->curl->response, true);
    }

    /**
     * Получить сообщение об ошибке
     * @return string
     */
    protected function parseErrorMessages()
    {
        if (!isset($this->curl->response['message']))
            return self::ERROR_MSG_INVALID_RESPONSE_DATA;

        if (!is_array($this->curl->response['message']))
            return $this->curl->response['message'];
    }


}