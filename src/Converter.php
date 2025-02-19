<?php

declare(strict_types=1);

namespace Grzegab\CurrencyTranslator;

class Converter
{
    private const string FRACTIONAL_ENDING = "/100";
    private const string SPACE = " ";
    
    public static function main(string $amount): string
    {
        if (!is_numeric($amount)) {
            throw new \InvalidArgumentException("Invalid amount input: must be a numeric string.");
        }


        if ($amount === "0") {
            return "zero złotych";
        }

        if ($amount === "1") {
            return "jeden złoty";
        }

        /**
         * Splits the number into reversed 3-digit chunks for processing.
         * Helps to process numbers 1234 become [1] and [4,3,2] for counting process.
         */
        $mainDividedReverse = array_chunk(array_reverse(str_split($amount)), 3);
        $mainCount = count($mainDividedReverse);

        $numbers = [];
        for ($chunks = 0; $chunks < $mainCount; $chunks++) {
            $text = [];
            $numberFixed = array_pad($mainDividedReverse[$chunks], 3, "0");

            if ((int)$numberFixed[2] > 0) {
                $text[] = NumberToWordsConverter::HUNDRETS_MAP[(int)$numberFixed[2]];
            }

            if ((int)$numberFixed[1] === 1) {
                $text[] = NumberToWordsConverter::TENTHS_SINGLE_MAP[(int)$numberFixed[0]];
            } elseif ((int)$numberFixed[1] > 1) {
                $text[] = NumberToWordsConverter::TENTHS_MAP[(int)$numberFixed[1]];
            }

            if ((int)$numberFixed[0] > 0 && (int)$numberFixed[1] !== 1) {
                $text[] = NumberToWordsConverter::SINGLE_MAP[(int)$numberFixed[0]];
            }

            $text[] = self::mapEnding($chunks, array_reverse($numberFixed));
            $numbers[] = implode(self::SPACE, $text);
        }

        return implode(self::SPACE, array_reverse($numbers));
    }

    public static function fractional(string $amount): string
    {
        if (!is_numeric($amount)) {
            throw new \InvalidArgumentException("Invalid amount input: must be a numeric string.");
        }

        if ($amount === "00") {
            $amount = "0";
        }

        return $amount . self::FRACTIONAL_ENDING;
    }

    private static function mapEnding(int $chunk, array $numbers): string
    {
        $lastNumber = (int)end($numbers);

        if ($numbers[1] === "1") {
            return NumberToWordsConverter::ENDINGS_EXCEPTION_MAP[$chunk] ?? '';
        }

        if ((int)$numbers[1] > 1) {
            return NumberToWordsConverter::ENDINGS_MULTIPLE_EXCEPTION_MAP[$chunk][$lastNumber] ?? '';
        }

        if ((int)$numbers[0] === 0 && (int)$numbers[1] === 0 && (int)$numbers[2] === 1) {
            return NumberToWordsConverter::ENDINGS_SINGLE_EXCEPTION_MAP[$chunk][$lastNumber] ?? '';
        }

        return NumberToWordsConverter::ENDINGS_MAP[$chunk][$lastNumber] ?? '';
    }
}