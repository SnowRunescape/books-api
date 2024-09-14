<?php

namespace app\validators;

use yii\validators\Validator;

class CpfValidator extends Validator
{
    public function validateAttribute($model, $attribute)
    {
        $cpf = preg_replace('/[^0-9]/', '', $model->$attribute);

        if (strlen($cpf) != 11) {
            $this->addError($model, $attribute, 'O CPF deve conter 11 dígitos.');
            return;
        }

        if (preg_match('/(\d)\1{10}/', $cpf)) {
            $this->addError($model, $attribute, 'CPF inválido.');
            return;
        }

        for ($t = 9; $t < 11; $t++) {
            $d = 0;
            for ($c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                $this->addError($model, $attribute, 'CPF inválido.');
                return;
            }
        }
    }
}
