<?php

namespace Grzegab\Translator;

use Grzegab\CurrencyTranslator\Translator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class CurrencyTest extends TestCase
{
    #[Test]
    #[DataProvider('zeroDataProvider')]
    public function zero(float $input, string $expected): void
    {
        $this->assertEquals($expected, Translator::convert($input));
    }

    #[Test]
    #[DataProvider('oneDigitDataProvider')]
    public function testOneDigit(float $input, string $expected): void
    {
        $this->assertEquals($expected, Translator::convert($input));
    }

    #[Test]
    #[DataProvider('twoDigitDataProvider')]
    public function testTwoDigit(float $input, string $expected): void
    {
        $this->assertEquals($expected, Translator::convert($input));
    }

    #[Test]
    #[DataProvider('twoDigitDataProvider')]
    public function thousands(float $amount, string $expected): void
    {
        $this->assertEquals($expected, Translator::convert($amount));
    }

    #[Test]
    #[DataProvider('randomDataProvider')]
    public function random(float $amount, string $expected): void
    {
        $this->assertEquals($expected, Translator::convert($amount));
    }

    public function zeroDataProvider(): array
    {
        return [
            [0, 'zero złotych i 0/100'],
            [0.0, 'zero złotych i 0/100'],
            [00000.0, 'zero złotych i 0/100'],
            [00000, 'zero złotych i 0/100'],
            [00000.000000, 'zero złotych i 0/100'],
        ];
    }

    public function oneDigitDataProvider(): array
    {
        return [
            [1, 'jeden złoty i 0/100'],
            [1.0, 'jeden złoty i 0/100'],
            [2, 'dwa złote i 0/100'],
            [2.0, 'dwa złote i 0/100'],
            [3, 'trzy złote i 0/100'],
            [3.0, 'trzy złote i 0/100'],
            [4, 'cztery złote i 0/100'],
            [4.0, 'cztery złote i 0/100'],
            [5, 'pięć złotych i 0/100'],
            [5.0, 'pięć złotych i 0/100'],
            [6, 'sześć złotych i 0/100'],
            [6.0, 'sześć złotych i 0/100'],
            [7, 'siedem złotych i 0/100'],
            [7.0, 'siedem złotych i 0/100'],
            [8, 'osiem złotych i 0/100'],
            [8.0, 'osiem złotych i 0/100'],
            [9, 'dziewięć złotych i 0/100'],
            [9.0, 'dziewięć złotych i 0/100'],
        ];
    }

    public function twoDigitDataProvider(): array
    {
        return [
            [10, 'dziesięć złotych i 0/100'],
            [10.0, 'dziesięć złotych i 0/100'],
            [11, 'jedenaście złotych i 0/100'],
            [11.0, 'jedenaście złotych i 0/100'],
            [12, 'dwanaście złotych i 0/100'],
            [12.0, 'dwanaście złotych i 0/100'],
            [13, 'trzynaście złotych i 0/100'],
            [13.30, 'trzynaście złotych i 30/100'],
            [14, 'czternaście złotych i 0/100'],
            [14.0, 'czternaście złotych i 0/100'],
            [15, 'piętnaście złotych i 0/100'],
            [15.0, 'piętnaście złotych i 0/100'],
            [16, 'szesnaście złotych i 0/100'],
            [16.0, 'szesnaście złotych i 0/100'],
            [17, 'siedemnaście złotych i 0/100'],
            [17.0, 'siedemnaście złotych i 0/100'],
            [18, 'osiemnaście złotych i 0/100'],
            [18.0, 'osiemnaście złotych i 0/100'],
            [19, 'dziewiętnaście złotych i 0/100'],
            [19.0, 'dziewiętnaście złotych i 0/100'],
            [20, 'dwadzieścia złotych i 0/100'],
            [20.0, 'dwadzieścia złotych i 0/100'],
            [21, 'dwadzieścia jeden złotych i 0/100'],
            [21.0, 'dwadzieścia jeden złotych i 0/100'],
            [23, 'dwadzieścia trzy złote i 0/100'],
            [23.0, 'dwadzieścia trzy złote i 0/100'],
            [26, 'dwadzieścia sześć złotych i 0/100'],
            [26.0, 'dwadzieścia sześć złotych i 0/100'],
            [29, 'dwadzieścia dziewięć złotych i 0/100'],
            [29.0, 'dwadzieścia dziewięć złotych i 0/100'],
            [30, 'trzydzieści złotych i 0/100'],
            [30.0, 'trzydzieści złotych i 0/100'],
            [32, 'trzydzieści dwa złote i 0/100'],
            [32.0, 'trzydzieści dwa złote i 0/100'],
            [34, 'trzydzieści cztery złote i 0/100'],
            [34.0, 'trzydzieści cztery złote i 0/100'],
            [38, 'trzydzieści osiem złotych i 0/100'],
            [38.0, 'trzydzieści osiem złotych i 0/100'],
        ];
    }

    public function thousandsDataProvider(): array
    {
        return [
            [56341, 'pięćdzisiąt sześć tysięcy trzysta czterdzieści jeden złotych i 0/100'],
            [1002, 'jeden tysiąc dwa złote i 0/100'],
            [1012.35, 'jeden tysiąc dwanaście złotych i 35/100'],
            [12263, 'dwanaście tysięcy dwieście sześćdziesiąt trzy złote i 0/100'],
            [32263, 'trzydzieści dwa tysiące dwieście sześćdziesiąt trzy złote i 0/100'],
            [22263, 'dwadzieścia dwa tysiące dwieście sześćdziesiąt trzy złote i 0/100'],
            [24716.22, 'dwadzieścia cztery tysiące siedemset szesnaście złotych i 22/100'],
            [26712.10, 'dwadzieścia sześć tysięcy siedemset dwanaście złotych i 10/100'],
            [29989, 'dwadzieścia dziewięć tysięcy dziewięćset osiemdziesiąt dziewięć złotych i 0/100'],
            [35812, 'trzydzieści pięć tysięcy osiemset dwanaście złotych i 0/100'],
            [43237, 'czterdzieści trzy tysiące dwieście trzydzieści siedem złotych i 0/100'],
            [50101, 'pięćdziesiąt tysięcy sto jeden złotych i 0/100'],
            [64321, 'sześćdziesiąt cztery tysiące trzysta dwadzieścia jeden złotych i 0/100'],
            [75954, 'siedemdziesiąt pięć tysięcy dziewięćset pięćdziesiąt cztery złote i 0/100'],
            [81444, 'osiemdziesiąt jeden tysięcy czterysta czterdzieści cztery złote i 0/100'],
            [97771, 'dziewięćdziesiąt siedem tysięcy siedemset siedemdziesiąt jeden złotych i 0/100'],
            [23070, 'dwadzieścia trzy tysiące siedemdziesiąt złotych i 0/100'],
            [23170, 'dwadzieścia trzy tysiące sto siedemdziesiąt złotych i 0/100'],
            [23970, 'dwadzieścia trzy tysiące dziewięćset siedemdziesiąt złotych i 0/100'],
            [23975, 'dwadzieścia trzy tysiące dziewięćset siedemdziesiąt pięć złotych i 0/100'],
        ];
    }

    public function randomDataProvider(): array
    {
        return [
            [7933.50, 'siedem tysięcy dziewięćset trzydzieści trzy złote i 50/100'],
            [9297.57, 'dziewięć tysięcy dwieście dziewięćdziesiąt siedem złotych i 57/100'],
            [9474.08, 'dziewięć tysięcy czterysta siedemdziesiąt cztery złote i 08/100'],
            [5596.50, 'pięć tysięcy pięćset dziewięćdziesiąt sześć złotych i 50/100'],
            [9027.59, 'dziewięć tysięcy dwadzieścia siedem złotych i 59/100'],
            [2460, 'dwa tysiące czterysta sześćdziesiąt złotych i 0/100'],
            [9555.87, 'dziewięć tysięcy pięćset pięćdziesiąt pięć złotych i 87/100'],
            [6957.50, 'sześć tysięcy dziewięćset pięćdziesiąt siedem złotych i 50/100'],
            [3624.20, 'trzy tysiące sześćset dwadzieścia cztery złote i 20/100'],
            [2308.71, 'dwa tysiące trzysta osiem złotych i 71/100'],
            [2308.78, 'dwa tysiące trzysta osiem złotych i 78/100'],
            [20000.56704, 'dwadzieścia tysięcy złotych i 57/100'],
            [19714, 'dziewiętnaście tysięcy siedemset czternaście złotych i 0/100'],
            [18990, 'osiemnaście tysięcy dziewięćset dziewięćdziesiąt złotych i 0/100'],
            [17301, 'siedemnaście tysięcy trzysta jeden złotych i 0/100'],
            [16070, 'szesnaście tysięcy siedemdziesiąt złotych i 0/100'],
            [15515, 'piętnaście tysięcy pięćset piętnaście złotych i 0/100'],
            [14013, 'czternaście tysięcy trzynaście złotych i 0/100'],
            [13011, 'trzynaście tysięcy jedenaście złotych i 0/100'],
            [12630, 'dwanaście tysięcy sześćset trzydzieści złotych i 0/100'],
            [11742, 'jedenaście tysięcy siedemset czterdzieści dwa złote i 0/100'],
            [10349, 'dziesięć tysięcy trzysta czterdzieści dziewięć złotych i 0/100'],
            [10129, 'dziesięć tysięcy sto dwadzieścia dziewięć złotych i 0/100'],
            [10055, 'dziesięć tysięcy pięćdziesiąt pięć złotych i 0/100'],
            [10001, 'dziesięć tysięcy jeden złotych i 0/100'],
            [10000.23, 'dziesięć tysięcy złotych i 23/100'],
            [10000, 'dziesięć tysięcy złotych i 0/100'],
            [9760, 'dziewięć tysięcy siedemset sześćdziesiąt złotych i 0/100'],
            [8888, 'osiem tysięcy osiemset osiemdziesiąt osiem złotych i 0/100'],
            [7654, 'siedem tysięcy sześćset pięćdziesiąt cztery złote i 0/100'],
            [6920, 'sześć tysięcy dziewięćset dwadzieścia złotych i 0/100'],
            [5005, 'pięć tysięcy pięć złotych i 0/100'],
            [4893, 'cztery tysiące osiemset dziewięćdziesiąt trzy złote i 0/100'],
            [4559.38, 'cztery tysiące pięćset pięćdziesiąt dziewięć złotych i 38/100'],
            [3624.20, 'trzy tysiące sześćset dwadzieścia cztery złote i 20/100'],
            [3125, 'trzy tysiące sto dwadzieścia pięć złotych i 0/100'],
            [2001, 'dwa tysiące jeden złotych i 0/100'],
            [2000, 'dwa tysiące złotych i 0/100'],
            [1999, 'jeden tysiąc dziewięćset dziewięćdziesiąt dziewięć złotych i 0/100'],
            [1855, 'jeden tysiąc osiemset pięćdziesiąt pięć złotych i 0/100'],
            [1783, 'jeden tysiąc siedemset osiemdziesiąt trzy złote i 0/100'],
            [1629, 'jeden tysiąc sześćset dwadzieścia dziewięć złotych i 0/100'],
            [1561, 'jeden tysiąc pięćset sześćdziesiąt jeden złotych i 0/100'],
            [1444, 'jeden tysiąc czterysta czterdzieści cztery złote i 0/100'],
            [1355, 'jeden tysiąc trzysta pięćdziesiąt pięć złotych i 0/100'],
            [1292, 'jeden tysiąc dwieście dziewięćdziesiąt dwa złote i 0/100'],
            [1238, 'jeden tysiąc dwieście trzydzieści osiem złotych i 0/100'],
            [1211, 'jeden tysiąc dwieście jedenaście złotych i 0/100'],
            [1200, 'jeden tysiąc dwieście złotych i 0/100'],
            [1199, 'jeden tysiąc sto dziewięćdziesiąt dziewięć złotych i 0/100'],
            [1157, 'jeden tysiąc sto pięćdziesiąt siedem złotych i 0/100'],
            [1123, 'jeden tysiąc sto dwadzieścia trzy złote i 0/100'],
            [1100.55, 'jeden tysiąc sto złotych i 55/100'],
            [1100, 'jeden tysiąc sto złotych i 0/100'],
            [1093, 'jeden tysiąc dziewięćdziesiąt trzy złote i 0/100'],
            [1084, 'jeden tysiąc osiemdziesiąt cztery złote i 0/100'],
            [1072, 'jeden tysiąc siedemdziesiąt dwa złote i 0/100'],
            [1065, 'jeden tysiąc sześćdziesiąt pięć złotych i 0/100'],
            [1059, 'jeden tysiąc pięćdziesiąt dziewięć złotych i 0/100'],
            [1048, 'jeden tysiąc czterdzieści osiem złotych i 0/100'],
            [1036, 'jeden tysiąc trzydzieści sześć złotych i 0/100'],
            [1035, 'jeden tysiąc trzydzieści pięć złotych i 0/100'],
            [1034, 'jeden tysiąc trzydzieści cztery złote i 0/100'],
            [1031, 'jeden tysiąc trzydzieści jeden złotych i 0/100'],
            [1030, 'jeden tysiąc trzydzieści złotych i 0/100'],
            [1027, 'jeden tysiąc dwadzieścia siedem złotych i 0/100'],
            [1023, 'jeden tysiąc dwadzieścia trzy złote i 0/100'],
            [1022, 'jeden tysiąc dwadzieścia dwa złote i 0/100'],
            [1020, 'jeden tysiąc dwadzieścia złotych i 0/100'],
            [1015.68, 'jeden tysiąc piętnaście złotych i 68/100'],
            [1019, 'jeden tysiąc dziewiętnaście złotych i 0/100'],
            [1017, 'jeden tysiąc siedemnaście złotych i 0/100'],
            [1015, 'jeden tysiąc piętnaście złotych i 0/100'],
            [1013, 'jeden tysiąc trzynaście złotych i 0/100'],
            [1011, 'jeden tysiąc jedenaście złotych i 0/100'],
            [1010, 'jeden tysiąc dziesięć złotych i 0/100'],
            [1005.22, 'jeden tysiąc pięć złotych i 22/100'],
            [1009, 'jeden tysiąc dziewięć złotych i 0/100'],
            [1005, 'jeden tysiąc pięć złotych i 0/100'],
            [1003, 'jeden tysiąc trzy złote i 0/100'],
            [1002, 'jeden tysiąc dwa złote i 0/100'],
            [1001, 'jeden tysiąc jeden złotych i 0/100'],
            [1000.27, 'jeden tysiąc złotych i 27/100'],
            [1000, 'jeden tysiąc złotych i 0/100'],
            [999, 'dziewięćset dziewięćdziesiąt dziewięć złotych i 0/100'],
            [855, 'osiemset pięćdziesiąt pięć złotych i 0/100'],
            [783, 'siedemset osiemdziesiąt trzy złote i 0/100'],
            [629, 'sześćset dwadzieścia dziewięć złotych i 0/100'],
            [561, 'pięćset sześćdziesiąt jeden złotych i 0/100'],
            [444, 'czterysta czterdzieści cztery złote i 0/100'],
            [355, 'trzysta pięćdziesiąt pięć złotych i 0/100'],
            [292, 'dwieście dziewięćdziesiąt dwa złote i 0/100'],
            [238, 'dwieście trzydzieści osiem złotych i 0/100'],
            [211, 'dwieście jedenaście złotych i 0/100'],
            [200, 'dwieście złotych i 0/100'],
            [199, 'sto dziewięćdziesiąt dziewięć złotych i 0/100'],
            [157, 'sto pięćdziesiąt siedem złotych i 0/100'],
            [123, 'sto dwadzieścia trzy złote i 0/100'],
            [100.55, 'sto złotych i 55/100'],
            [100, 'sto złotych i 0/100'],
            [93, 'dziewięćdziesiąt trzy złote i 0/100'],
            [84, 'osiemdziesiąt cztery złote i 0/100'],
            [72, 'siedemdziesiąt dwa złote i 0/100'],
            [65, 'sześćdziesiąt pięć złotych i 0/100'],
            [59, 'pięćdziesiąt dziewięć złotych i 0/100'],
            [48, 'czterdzieści osiem złotych i 0/100'],
            [36, 'trzydzieści sześć złotych i 0/100'],
            [35, 'trzydzieści pięć złotych i 0/100'],
            [34, 'trzydzieści cztery złote i 0/100'],
        ];
    }
}
