<?php

namespace app\controllers;

use app\models\Book;
use app\services\BookService;
use Yii;
use yii\rest\ActiveController;

class BookController extends ActiveController
{
    public $modelClass = Book::class;

    public function actions()
    {
        $actions = parent::actions();

        unset($actions['index']);

        return $actions;
    }

    public function actionIndex()
    {
        $books = (new BookService())->getBooks([
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
