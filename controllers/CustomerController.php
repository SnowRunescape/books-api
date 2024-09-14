<?php

namespace app\controllers;

use app\models\Customer;
use app\services\CustomerService;
use Yii;
use yii\rest\ActiveController;

class CustomerController extends ActiveController
{
    public $modelClass = Customer::class;

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

    public function actions()
    {
        $actions = parent::actions();

        unset($actions['index']);

        return $actions;
    }

    public function actionIndex()
    {
        $books = (new CustomerService())->getCustomers([
            'filters' => Yii::$app->request->queryParams,
            'limit' => (int) Yii::$app->request->get('limit'),
            'offset' => (int) Yii::$app->request->get('offset'),
        ]);

        return [
            'data' => $books->getModels(),
            'total' => $books->getTotalCount(),
        ];
    }
}
