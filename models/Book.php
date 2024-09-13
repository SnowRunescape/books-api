<?php

namespace app\models;

use app\validators\IsbnValidator;

class Book extends \yii\db\ActiveRecord
{
    /**
     * Define o nome da tabela associada a esta model.
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * Define as regras de validação para os atributos do modelo.
     */
    public function rules()
    {
        return [
            [['title', 'author', 'isbn', 'price', 'stock'], 'required'],
            [['title', 'author', 'isbn'], 'string', 'max' => 255],
            [['price'], 'number'],
            [['stock'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            ['isbn', IsbnValidator::class],
        ];
    }
}
