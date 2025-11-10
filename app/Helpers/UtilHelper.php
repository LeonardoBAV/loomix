<?php

namespace App\Helpers;

class UtilHelper
{
    public static function formatMoney(float $value): string
    {
        return 'R$ '.number_format($value, 2, ',', '.');
    }
}
