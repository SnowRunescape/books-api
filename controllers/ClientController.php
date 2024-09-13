<?php

namespace app\controllers;

use app\models\Client;
use app\traits\AuthTrait;
use yii\rest\ActiveController;

class ClientController extends ActiveController
{
    use AuthTrait;

    public $modelClass = Client::class;
}
