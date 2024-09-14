<?php

namespace app\models;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    protected $authKey;

    public static function tableName()
    {
        return 'users';
    }

    public function fields()
    {
        $fields = parent::fields();

        unset($fields['password']);

        return $fields;
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isAttributeChanged('password')) {
                $this->password = Yii::$app->security->generatePasswordHash($this->password);
            }

            return true;
        }

        return false;
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        try {
            $jwt = JWT::decode($token, new Key(getenv('JWT_SECRET'), 'HS256'));

            return self::findIdentity($jwt->sub);
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }
}
