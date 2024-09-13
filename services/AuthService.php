<?php

namespace app\services;

use app\models\User;
use Firebase\JWT\JWT;
use Yii;
use yii\web\BadRequestHttpException;

class AuthService
{
    public function login(string $login, string $password)
    {
        $user = User::findOne(['login' => $login]);

        if ($user !== null && $user->validatePassword($password)) {
            Yii::$app->user->login($user);
            return [
                'user' => $user,
                'token' => $this->generateJwt($user),
            ];
        }

        // Se o login ou a senha estiverem incorretos, lance uma exceção
        throw new BadRequestHttpException('Login ou senha incorretos.');
    }

    private function generateJwt(User $user)
    {
        $payload = [
            'iss' => 'book-api',
            'iat' => time(),
            'exp' => time() + 3600,
            'sub' => $user->id,
        ];

        return JWT::encode($payload, getenv('JWT_SECRET'), 'HS256');
    }
}
