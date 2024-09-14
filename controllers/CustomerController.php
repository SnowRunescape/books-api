<?php

namespace app\controllers;

use app\models\Customer;
use app\services\CustomerService;
use app\traits\AuthTrait;
use Yii;
use yii\rest\ActiveController;

class CustomerController extends ActiveController
{
    use AuthTrait;

    public $modelClass = Customer::class;

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
