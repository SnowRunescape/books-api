<?php

namespace app\controllers;

use app\services\AuthService;
use Yii;
use yii\base\Controller;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $this->authService = new AuthService();
    }

    public function actionLogin()
    {
        $request = Yii::$app->request;

        $login = $request->post('login', '');
        $password = $request->post('password', '');

        $result = $this->authService->login($login, $password);

        return [
            'user' => $result['user'],
            'token' => $result['token'],
        ];
    }
}
