<?php
namespace Thiagoprz\CpfCnpjValidator;

use Illuminate\Validation\Rule;

/**
 * Class CpfCnpj
 * @package Thiagoprz\CpfCnpjValidator
 */
class CpfCnpj extends Rule
{

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct() {}

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  string  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (!empty($value)) {
            $value = preg_replace('/[^0-9]/', '', (string)$value);
            if (strlen($value) == 11) {
                return $this->validateCpf($attribute, $value);
            }
            if (strlen($value) == 14) {
                return $this->validateCnpj($attribute, $value);
            }
        }
        return false;
    }

    /**
     * @param string $attribute
     * @param string $cpf
     * @return bool
     */
    private function validateCpf($attribute, $cpf)
    {
        // Check size number
        if (strlen($cpf) != 11 || preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }
        // Validating based on the calculation of the CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
    }

    /**
     * @param string $attribute
     * @param string $cnpj
     * @return bool
     */
    private function validateCnpj($attribute, $cnpj)
    {
        // Validating size
        if (strlen($cnpj) != 14) {
            return false;
        }
        // Validating first check digit
        for ($i = 0, $j = 5, $sum = 0; $i < 12; $i++)
        {
            $sum += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $rest = $sum % 11;
        if ($cnpj[12] != ($rest < 2 ? 0 : 11 - $rest)) {
            return false;
        }
        // Validating second check digit
        for ($i = 0, $j = 6, $sum = 0; $i < 13; $i++)
        {
            $sum += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $rest = $sum % 11;
        return $cnpj[13] == ($rest < 2 ? 0 : 11 - $rest);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('cpf_cnpj-validator::validation.cpf_cnpj');
    }
}
