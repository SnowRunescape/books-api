<?php

namespace app\services;

use app\models\Customer;
use yii\data\ActiveDataProvider;

class CustomerService
{
    public function getCustomers(array $params)
    {
        $query = Customer::find();

        if (!empty($params['filters']['name'])) {
            $query->andFilterWhere(['like', 'name', $params['filters']['name']]);
        }

        if (!empty($params['filters']['cpf'])) {
            $query->andFilterWhere(['cpf' => $params['filters']['cpf']]);
        }

        $limit = ($params['limit'] > 0) ? $params['limit'] : 20;
        $offset = $params['offset'] ?? 0;

        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $limit,
                'page' => floor($offset / $limit),
            ],
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC],
                'attributes' => ['id', 'name', 'cpf', 'city'],
            ],
        ]);
    }
}
