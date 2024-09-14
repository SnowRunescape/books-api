<?php

namespace app\models;

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
            [['cpf'], 'validateCpf'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    public function validateCpf($attribute, $params)
    {
        $cpf = preg_replace('/[^0-9]/', '', $this->$attribute);

        if (strlen($cpf) != 11) {
            $this->addError($attribute, 'O CPF deve conter 11 dígitos.');
            return;
        }

        if (preg_match('/(\d)\1{10}/', $cpf)) {
            $this->addError($attribute, 'CPF inválido.');
            return;
        }

        for ($t = 9; $t < 11; $t++) {
            $d = 0;
            for ($c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                $this->addError($attribute, 'CPF inválido.');
                return;
            }
        }
    }
}
