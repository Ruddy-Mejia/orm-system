<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class RutChileno implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Limpiar el RUT
        $rut = str_replace(['.', '-'], '', $value);
        
        if (!preg_match('/^[0-9]{7,8}[0-9Kk]$/', $rut)) {
            $fail('El RUT no es válido.');
            return;
        }
        
        // Validar dígito verificador
        $rut_num = substr($rut, 0, -1);
        $dv = substr($rut, -1);
        
        $sum = 0;
        $multiplier = 2;
        for ($i = strlen($rut_num) - 1; $i >= 0; $i--) {
            $sum += intval($rut_num[$i]) * $multiplier;
            $multiplier++;
            if ($multiplier > 7) {
                $multiplier = 2;
            }
        }
        
        $expected_dv = 11 - ($sum % 11);
        if ($expected_dv == 11) $expected_dv = '0';
        if ($expected_dv == 10) $expected_dv = 'K';
        
        if (strtoupper($dv) != $expected_dv) {
            $fail('El RUT no es válido.');
        }
    }
}