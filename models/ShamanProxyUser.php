<?php

namespace app\models;

use yii\base\Model;

class ShamanProxyUser extends Model
{

    public $id;
    public $name;
    public $email;
    public $isActive;
    public $role_id;
    public $isFirstTime;
    public $onCreated;
    public $onPasswordChanged;
    public $isBlocked;
    public $sfid;
    public $onDeleted;
    public $avatarInfo;
    public $phone;
    public $avatar_id;
    public $groups;
    public $role;
    public $roleName;
    public $intercomUserHash;
    public $token;
    public $secretKey;

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'email' => 'E-mail',
            'roleName' => 'Роль',
            'secretKey' => 'Секретный ключ',
        ];
    }

    public function fields()
    {
        return [
            'id',
            'name',
            'email',
            'roleName' => function () {
                return $this->role['name'];
            },
            'secretKey' => function () {
                return base64_decode($this->secretKey);
            },
        ];
    }

}