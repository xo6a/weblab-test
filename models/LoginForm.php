<?php

namespace app\models;

use yii\base\Model;

class LoginForm extends Model
{
    public $email;
    public $password;
    public $curlname;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['email', 'required', 'message' => 'Укажите e-mail.'],
            ['password', 'required', 'message' => 'Укажите пароль.'],
            ['curlname', 'required', 'message' => 'Укажите название компании.'],
            ['email', 'email', 'message' => 'Введите корректный e-mail.'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => 'E-mail',
            'password' => 'Пароль',
            'curlname' => 'Название компании',
        ];
    }

}
