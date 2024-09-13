<?php

namespace app\validators;

use yii\validators\Validator;
use GuzzleHttp\Client;

class IsbnValidator extends Validator
{
    public function validateAttribute($model, $attribute)
    {
        $client = new Client();
        $isbn = $model->$attribute;

        try {
            $response = $client->get("https://brasilapi.com.br/api/isbn/v1/{$isbn}");
            $data = json_decode($response->getBody(), true);

            if (empty($data['isbn'])) {
                $this->addError($model, $attribute, 'O ISBN fornecido é inválido.');
            }
        } catch (\Exception $e) {
            $this->addError($model, $attribute, 'O ISBN fornecido é inválido.');
        }
    }
}
