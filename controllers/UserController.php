<?php

namespace app\controllers;

use Yii;
use yii\rest\Controller;

class UserController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::class,
        ];

        unset($behaviors['authenticator']);

        $behaviors['authenticator'] = [
            'class' => \yii\filters\auth\HttpBearerAuth::class,
            'except' => ['options'],
        ];

        return $behaviors;
    }

    public function actionIndex()
    {
        return $this->asJson(Yii::$app->user->identity);
    }
}
