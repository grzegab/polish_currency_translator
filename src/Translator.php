<?php

declare(strict_types=1);

namespace Grzegab\CurrencyTranslator;

class Translator
{
    public static function convert(float $amount, bool $fractionText = false): string
    {
        Amount::verify($amount);

        $return = '';

        if ($amount < 0) {
            $return .= 'minus ';
        }

        [$mainAmount, $fractionalAmount] = Amount::convert($amount);

        $return .= Converter::main($mainAmount);
        $return .= ' i ';
        $return .= Converter::fractional($fractionalAmount, $fractionText);

        return $return;
    }
}