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
        return 'customers';
    }

    /**
     * Define as regras de validação para os atributos do modelo.
     */
    public function rules()
    {
        return [
            [['name', 'cpf', 'cep', 'street', 'number', 'city', 'state', 'complement', 'gender'], 'required'],
            [['name', 'street', 'complement'], 'string', 'max' => 255],
            [['number'], 'string', 'max' => 10],
            [['state'], 'string', 'max' => 2],
            ['gender', 'in', 'range' => ['M', 'F']],
            [['created_at', 'updated_at'], 'safe'],
            ['cpf', CpfValidator::class],
        ];
    }

    public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            $this->cpf = preg_replace('/[.-]/', '', $this->cpf);
            return true;
        }

        return false;
    }
}
