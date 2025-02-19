<?php

declare(strict_types=1);

namespace Grzegab\Translator;

use Grzegab\CurrencyTranslator\Amount;
use Grzegab\CurrencyTranslator\Exceptions\AmountTooBigException;
use Grzegab\CurrencyTranslator\Exceptions\AmountTooSmallException;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;

class AmountTest extends TestCase
{
    #[Test]
    public function tooBig(): void
    {
        self::expectException(AmountTooBigException::class);
        Amount::verify(100000000001);
    }

    #[Test]
    public function tooSmall(): void
    {
        self::expectException(AmountTooSmallException::class);
        Amount::verify(-11000000000000);
    }

    #[Test]
    #[DataProvider('amountDataset')]
    public function testConvertToString(float $input, array $expected): void
    {
        $result = Amount::convert($input);
        self::assertSame($expected, $result);
    }

    public function amountDataset(): array
    {
        return [
            [1234.5678, ['1234', '57']],
            [1000.00, ['1000', '00']],
            [0.99, ['0', '99']],
            [-123.45, ['-123', '45']],
            [0, ['0', '00']],
            [-192, ['-192', '00']],
        ];
    }
}