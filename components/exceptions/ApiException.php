<?php

namespace app\components\exceptions;

class ApiException extends \yii\web\HttpException
{
    public function __construct($status, $message = null, $code = 0, \Exception $previous = null)
    {
        parent::__construct($status, $message, $code, $previous);
    }
}