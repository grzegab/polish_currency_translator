<?php

declare(strict_types=1);

namespace Grzegab\Translator;

use Grzegab\CurrencyTranslator\Converter;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class ConverterTest extends TestCase
{
    #[Test]
    #[DataProvider('fractionalNumberDataset')]
    public function fractionalNumber(string $amount, string $expected): void
    {
        $result = Converter::fractional($amount);
        self::assertSame($expected, $result);
    }

    public function fractionalNumberDataset(): array
    {
        return [
            ["0", "0/100"],
            ["00", "0/100"],
            ["7", "7/100"],
            ["75", "75/100"],
            ["14", "14/100"],
            ["18", "18/100"],
        ];
    }
}