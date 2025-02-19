<?php

declare(strict_types=1);

namespace Grzegab\CurrencyTranslator;

use Grzegab\CurrencyTranslator\Exceptions\AmountTooBigException;
use Grzegab\CurrencyTranslator\Exceptions\AmountTooSmallException;

class Amount
{
    private const MAX_AMOUNT = 999_999_999.99;
    private const MIN_AMOUNT = -999_999_999.99;


    public static function verify(float $amount): void
    {
        $number = (int)$amount;

        if ($number > self::MAX_AMOUNT) {
            throw new AmountTooBigException("Provided number is too big.");
        }

        if ($number < self::MIN_AMOUNT) {
            throw new AmountTooSmallException("Provided number is too small.");
        }
    }

    public static function convert(float $amount): array
    {
        $amountRounded = sprintf('%.2f', number_format($amount, 2, '.', ''));

        return explode('.', $amountRounded);
    }
}