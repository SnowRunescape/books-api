<?php

namespace app\services;

use app\models\Book;
use yii\data\ActiveDataProvider;

class BookService
{
    public function getBooks(array $params)
    {
        $query = Book::find();

        if (!empty($params['filters']['title'])) {
            $query->andFilterWhere(['like', 'title', $params['filters']['title']]);
        }

        if (!empty($params['filters']['author'])) {
            $query->andFilterWhere(['like', 'author', $params['filters']['author']]);
        }

        if (!empty($params['filters']['isbn'])) {
            $query->andFilterWhere(['isbn' => $params['filters']['isbn']]);
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
                'attributes' => ['id', 'title', 'price'],
            ],
        ]);
    }
}
