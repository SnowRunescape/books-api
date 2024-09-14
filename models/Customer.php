<?php

namespace app\models;

use app\validators\CpfValidator;

class Customer extends \yii\db\ActiveRecord
{
    /**
     * Define o nome da tabela associada a esta model.
     */
    public static function tableName()
    {
        return 'clients';
    }

    /**
     * Define as regras de validação para os atributos do modelo.
     */
    public function rules()
    {
        return [
            [['cpf'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            ['isbn', CpfValidator::class],
        ];
    }
}
