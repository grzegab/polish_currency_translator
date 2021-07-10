<?php

namespace Grzegab\Translator;

use Grzegab\CurrencyTranslator\CurrencyTranslator;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class CurrencyTest extends TestCase
{
    public function testZero(): void
    {
        $currencyTranslator = new CurrencyTranslator();
        $this->assertEquals('zero złotych', $currencyTranslator->convert(0));
        $this->assertEquals('zero złotych', $currencyTranslator->convert(0.0));
        $this->assertEquals('zero złotych', $currencyTranslator->convert(00000.0));
        $this->assertEquals('zero złotych', $currencyTranslator->convert(00000));
        $this->assertEquals('zero złotych', $currencyTranslator->convert(00000.000000));
    }

    public function testOneDigit(): void
    {
        $currencyTranslator = new CurrencyTranslator();
        $this->assertEquals('jeden złoty', $currencyTranslator->convert(1));
        $this->assertEquals('jeden złoty', $currencyTranslator->convert(1.0));
        $this->assertEquals('dwa złote', $currencyTranslator->convert(2));
        $this->assertEquals('dwa złote', $currencyTranslator->convert(2.0));
        $this->assertEquals('trzy złote', $currencyTranslator->convert(3));
        $this->assertEquals('trzy złote', $currencyTranslator->convert(3.0));
        $this->assertEquals('cztery złote', $currencyTranslator->convert(4));
        $this->assertEquals('cztery złote', $currencyTranslator->convert(4.0));
        $this->assertEquals('pięć złotych', $currencyTranslator->convert(5));
        $this->assertEquals('pięć złotych', $currencyTranslator->convert(5.0));
        $this->assertEquals('sześć złotych', $currencyTranslator->convert(6));
        $this->assertEquals('sześć złotych', $currencyTranslator->convert(6.0));
        $this->assertEquals('siedem złotych', $currencyTranslator->convert(7));
        $this->assertEquals('siedem złotych', $currencyTranslator->convert(7.0));
        $this->assertEquals('osiem złotych', $currencyTranslator->convert(8));
        $this->assertEquals('osiem złotych', $currencyTranslator->convert(8.0));
        $this->assertEquals('dziewięć złotych', $currencyTranslator->convert(9));
        $this->assertEquals('dziewięć złotych', $currencyTranslator->convert(9.0));

    }

    public function testTwoDigit(): void
    {
        $currencyTranslator = new CurrencyTranslator();
        $this->assertEquals('dziesięć złotych', $currencyTranslator->convert(10));
        $this->assertEquals('dziesięć złotych', $currencyTranslator->convert(10.0));
        $this->assertEquals('jedenaście złotych', $currencyTranslator->convert(11));
        $this->assertEquals('jedenaście złotych', $currencyTranslator->convert(11.0));
        $this->assertEquals('dwanaście złotych', $currencyTranslator->convert(12));
        $this->assertEquals('dwanaście złotych', $currencyTranslator->convert(12.0));
        $this->assertEquals('trzynaście złotych', $currencyTranslator->convert(13));
        $this->assertEquals('trzynaście złotych 30/100', $currencyTranslator->convert(13.30));
        $this->assertEquals('czternaście złotych', $currencyTranslator->convert(14));
        $this->assertEquals('czternaście złotych', $currencyTranslator->convert(14.0));
        $this->assertEquals('piętnaście złotych', $currencyTranslator->convert(15));
        $this->assertEquals('piętnaście złotych', $currencyTranslator->convert(15.0));
        $this->assertEquals('szesnaście złotych', $currencyTranslator->convert(16));
        $this->assertEquals('szesnaście złotych', $currencyTranslator->convert(16.0));
        $this->assertEquals('siedemnaście złotych', $currencyTranslator->convert(17));
        $this->assertEquals('siedemnaście złotych', $currencyTranslator->convert(17.0));
        $this->assertEquals('osiemnaście złotych', $currencyTranslator->convert(18));
        $this->assertEquals('osiemnaście złotych', $currencyTranslator->convert(18.0));
        $this->assertEquals('dziewiętnaście złotych', $currencyTranslator->convert(19));
        $this->assertEquals('dziewiętnaście złotych', $currencyTranslator->convert(19.0));
        $this->assertEquals('dwadzieścia złotych', $currencyTranslator->convert(20));
        $this->assertEquals('dwadzieścia złotych', $currencyTranslator->convert(20.0));
        $this->assertEquals('dwadzieścia jeden złotych', $currencyTranslator->convert(21));
        $this->assertEquals('dwadzieścia jeden złotych', $currencyTranslator->convert(21.0));
        $this->assertEquals('dwadzieścia trzy złote', $currencyTranslator->convert(23));
        $this->assertEquals('dwadzieścia trzy złote', $currencyTranslator->convert(23.0));
        $this->assertEquals('dwadzieścia sześć złotych', $currencyTranslator->convert(26));
        $this->assertEquals('dwadzieścia sześć złotych', $currencyTranslator->convert(26.0));
        $this->assertEquals('dwadzieścia dziewięć złotych', $currencyTranslator->convert(29));
        $this->assertEquals('dwadzieścia dziewięć złotych', $currencyTranslator->convert(29.0));
        $this->assertEquals('trzydzieści złotych', $currencyTranslator->convert(30));
        $this->assertEquals('trzydzieści złotych', $currencyTranslator->convert(30.0));
        $this->assertEquals('trzydzieści dwa złote', $currencyTranslator->convert(32));
        $this->assertEquals('trzydzieści dwa złote', $currencyTranslator->convert(32.0));
        $this->assertEquals('trzydzieści cztery złote', $currencyTranslator->convert(34));
        $this->assertEquals('trzydzieści cztery złote', $currencyTranslator->convert(34.0));
        $this->assertEquals('trzydzieści osiem złotych', $currencyTranslator->convert(38));
        $this->assertEquals('trzydzieści osiem złotych', $currencyTranslator->convert(38.0));
    }

    public function testFactorOff(): void
    {
        $currencyTranslator = new CurrencyTranslator(showGrosze: false);
        $this->assertEquals('dziewięćset trzydzieści cztery złote', $currencyTranslator->convert(934.23));
        $this->assertEquals('jeden tysiąc dwanaście złotych', $currencyTranslator->convert(1012.35));
    }

    public function testThousands(): void
    {
        $currencyTranslator = new CurrencyTranslator();
        $this->assertEquals('jeden tysiąc dwa złote', $currencyTranslator->convert(1002));
        $this->assertEquals('jeden tysiąc dwanaście złotych 35/100', $currencyTranslator->convert(1012.35));
        $this->assertEquals('dwanaście tysięcy dwieście sześćdziesiąt trzy złote', $currencyTranslator->convert(12263));
        $this->assertEquals('trzydzieści dwa tysiące dwieście sześćdziesiąt trzy złote', $currencyTranslator->convert(32263));
        $this->assertEquals('dwadzieścia dwa tysiące dwieście sześćdziesiąt trzy złote', $currencyTranslator->convert(22263));
        $this->assertEquals('dwadzieścia cztery tysiące siedemset szesnaście złotych 22/100', $currencyTranslator->convert(24716.22));
        $this->assertEquals('dwadzieścia sześć tysięcy siedemset dwanaście złotych 10/100', $currencyTranslator->convert(26712.10));
        $this->assertEquals('dwadzieścia dziewięć tysięcy dziewięćset osiemdziesiąt dziewięć złotych', $currencyTranslator->convert(29989));
        $this->assertEquals('trzydzieści pięć tysięcy osiemset dwanaście złotych', $currencyTranslator->convert(35812));
        $this->assertEquals('czterdzieści trzy tysiące dwieście trzydzieści siedem złotych', $currencyTranslator->convert(43237));
        $this->assertEquals('pięćdziesiąt tysięcy sto jeden złotych', $currencyTranslator->convert(50101));
        $this->assertEquals('sześćdziesiąt cztery tysiące trzysta dwadzieścia jeden złotych', $currencyTranslator->convert(64321));
        $this->assertEquals('siedemdziesiąt pięć tysięcy dziewięćset pięćdziesiąt cztery złote', $currencyTranslator->convert(75954));
        $this->assertEquals('osiemdziesiąt jeden tysięcy czterysta czterdzieści cztery złote', $currencyTranslator->convert(81444));
        $this->assertEquals('dziewięćdziesiąt siedem tysięcy siedemset siedemdziesiąt jeden złotych', $currencyTranslator->convert(97771));
    }

    public function testRandom(): void
    {
        $currencyTranslator = new CurrencyTranslator();
        $this->assertEquals('siedem tysięcy dziewięćset trzydzieści trzy złote 50/100', $currencyTranslator->convert(7933.50));
        $this->assertEquals('dziewięć tysięcy dwieście dziewięćdziesiąt siedem złotych 57/100', $currencyTranslator->convert(9297.57));
        $this->assertEquals('dziewięć tysięcy czterysta siedemdziesiąt cztery złote 08/100', $currencyTranslator->convert(9474.08));
        $this->assertEquals('dziewięć tysięcy dwieście dziewięćdziesiąt siedem złotych 57/100', $currencyTranslator->convert(9297.57));
        $this->assertEquals('pięć tysięcy pięćset dziewięćdziesiąt sześć złotych 50/100', $currencyTranslator->convert(5596.50));
        $this->assertEquals('dziewięć tysięcy dwadzieścia siedem złotych 59/100', $currencyTranslator->convert(9027.59));
        $this->assertEquals('dwa tysiące czterysta sześćdziesiąt złotych', $currencyTranslator->convert(2460));
        $this->assertEquals('dziewięć tysięcy pięćset pięćdziesiąt pięć złotych 87/100', $currencyTranslator->convert(9555.87));
        $this->assertEquals('sześć tysięcy dziewięćset pięćdziesiąt siedem złotych 50/100', $currencyTranslator->convert(6957.50));
        $this->assertEquals('trzy tysiące sześćset dwadzieścia cztery złote 20/100', $currencyTranslator->convert(3624.20));
        $this->assertEquals('dwa tysiące trzysta osiem złotych 71/100', $currencyTranslator->convert(2308.71));
        $this->assertEquals('dwa tysiące trzysta osiem złotych 78/100', $currencyTranslator->convert(2308.78));
        $this->assertEquals('dwadzieścia tysięcy złotych 57/100', $currencyTranslator->convert(20000.56704));
        $this->assertEquals('dziewiętnaście tysięcy siedemset czternaście złotych', $currencyTranslator->convert(19714));
        $this->assertEquals('osiemnaście tysięcy dziewięćset dziewięćdziesiąt złotych', $currencyTranslator->convert(18990));
        $this->assertEquals('siedemnaście tysięcy trzysta jeden złotych', $currencyTranslator->convert(17301));
        $this->assertEquals('szesnaście tysięcy siedemdziesiąt złotych', $currencyTranslator->convert(16070));
        $this->assertEquals('piętnaście tysięcy pięćset piętnaście złotych', $currencyTranslator->convert(15515));
        $this->assertEquals('czternaście tysięcy trzynaście złotych', $currencyTranslator->convert(14013));
        $this->assertEquals('trzynaście tysięcy jedenaście złotych', $currencyTranslator->convert(13011));
        $this->assertEquals('dwanaście tysięcy sześćset trzydzieści złotych', $currencyTranslator->convert(12630));
        $this->assertEquals('jedenaście tysięcy siedemset czterdzieści dwa złote', $currencyTranslator->convert(11742));
        $this->assertEquals('dziesięć tysięcy trzysta czterdzieści dziewięć złotych', $currencyTranslator->convert(10349));
        $this->assertEquals('dziesięć tysięcy sto dwadzieścia dziewięć złotych', $currencyTranslator->convert(10129));
        $this->assertEquals('dziesięć tysięcy pięćdziesiąt pięć złotych', $currencyTranslator->convert(10055));
        $this->assertEquals('dziesięć tysięcy jeden złotych', $currencyTranslator->convert(10001));
        $this->assertEquals('dziesięć tysięcy złotych 23/100', $currencyTranslator->convert(10000.23));
        $this->assertEquals('dziesięć tysięcy złotych', $currencyTranslator->convert(10000));
        $this->assertEquals('dziewięć tysięcy siedemset sześćdziesiąt złotych', $currencyTranslator->convert(9760));
        $this->assertEquals('osiem tysięcy osiemset osiemdziesiąt osiem złotych', $currencyTranslator->convert(8888));
        $this->assertEquals('siedem tysięcy sześćset pięćdziesiąt cztery złote', $currencyTranslator->convert(7654));
        $this->assertEquals('sześć tysięcy dziewięćset dwadzieścia złotych', $currencyTranslator->convert(6920));
        $this->assertEquals('pięć tysięcy pięć złotych', $currencyTranslator->convert(5005));
        $this->assertEquals('cztery tysiące osiemset dziewięćdziesiąt trzy złote', $currencyTranslator->convert(4893));
        $this->assertEquals('cztery tysiące pięćset pięćdziesiąt dziewięć złotych 38/100', $currencyTranslator->convert(4559.38));
        $this->assertEquals('trzy tysiące sześćset dwadzieścia cztery złote 20/100', $currencyTranslator->convert(3624.20));
        $this->assertEquals('trzy tysiące sto dwadzieścia pięć złotych', $currencyTranslator->convert(3125));
        $this->assertEquals('dwa tysiące jeden złotych', $currencyTranslator->convert(2001));
        $this->assertEquals('dwa tysiące złotych', $currencyTranslator->convert(2000));
        $this->assertEquals('jeden tysiąc dziewięćset dziewięćdziesiąt dziewięć złotych', $currencyTranslator->convert(1999));
        $this->assertEquals('jeden tysiąc osiemset pięćdziesiąt pięć złotych', $currencyTranslator->convert(1855));
        $this->assertEquals('jeden tysiąc siedemset osiemdziesiąt trzy złote', $currencyTranslator->convert(1783));
        $this->assertEquals('jeden tysiąc sześćset dwadzieścia dziewięć złotych', $currencyTranslator->convert(1629));
        $this->assertEquals('jeden tysiąc pięćset sześćdziesiąt jeden złotych', $currencyTranslator->convert(1561));
        $this->assertEquals('jeden tysiąc czterysta czterdzieści cztery złote', $currencyTranslator->convert(1444));
        $this->assertEquals('jeden tysiąc trzysta pięćdziesiąt pięć złotych', $currencyTranslator->convert(1355));
        $this->assertEquals('jeden tysiąc dwieście dziewięćdziesiąt dwa złote', $currencyTranslator->convert(1292));
        $this->assertEquals('jeden tysiąc dwieście trzydzieści osiem złotych', $currencyTranslator->convert(1238));
        $this->assertEquals('jeden tysiąc dwieście jedenaście złotych', $currencyTranslator->convert(1211));
        $this->assertEquals('jeden tysiąc dwieście złotych', $currencyTranslator->convert(1200));
        $this->assertEquals('jeden tysiąc sto dziewięćdziesiąt dziewięć złotych', $currencyTranslator->convert(1199));
        $this->assertEquals('jeden tysiąc sto pięćdziesiąt siedem złotych', $currencyTranslator->convert(1157));
        $this->assertEquals('jeden tysiąc sto dwadzieścia trzy złote', $currencyTranslator->convert(1123));
        $this->assertEquals('jeden tysiąc sto złotych 55/100', $currencyTranslator->convert(1100.55));
        $this->assertEquals('jeden tysiąc sto złotych', $currencyTranslator->convert(1100));
        $this->assertEquals('jeden tysiąc dziewięćdziesiąt trzy złote', $currencyTranslator->convert(1093));
        $this->assertEquals('jeden tysiąc osiemdziesiąt cztery złote', $currencyTranslator->convert(1084));
        $this->assertEquals('jeden tysiąc siedemdziesiąt dwa złote', $currencyTranslator->convert(1072));
        $this->assertEquals('jeden tysiąc sześćdziesiąt pięć złotych', $currencyTranslator->convert(1065));
        $this->assertEquals('jeden tysiąc pięćdziesiąt dziewięć złotych', $currencyTranslator->convert(1059));
        $this->assertEquals('jeden tysiąc czterdzieści osiem złotych', $currencyTranslator->convert(1048));
        $this->assertEquals('jeden tysiąc trzydzieści sześć złotych', $currencyTranslator->convert(1036));
        $this->assertEquals('jeden tysiąc trzydzieści pięć złotych', $currencyTranslator->convert(1035));
        $this->assertEquals('jeden tysiąc trzydzieści cztery złote', $currencyTranslator->convert(1034));
        $this->assertEquals('jeden tysiąc trzydzieści jeden złotych', $currencyTranslator->convert(1031));
        $this->assertEquals('jeden tysiąc trzydzieści złotych', $currencyTranslator->convert(1030));
        $this->assertEquals('jeden tysiąc dwadzieścia siedem złotych', $currencyTranslator->convert(1027));
        $this->assertEquals('jeden tysiąc dwadzieścia trzy złote', $currencyTranslator->convert(1023));
        $this->assertEquals('jeden tysiąc dwadzieścia dwa złote', $currencyTranslator->convert(1022));
        $this->assertEquals('jeden tysiąc dwadzieścia złotych', $currencyTranslator->convert(1020));
        $this->assertEquals('jeden tysiąc piętnaście złotych 68/100', $currencyTranslator->convert(1015.68));
        $this->assertEquals('jeden tysiąc dziewiętnaście złotych', $currencyTranslator->convert(1019));
        $this->assertEquals('jeden tysiąc siedemnaście złotych', $currencyTranslator->convert(1017));
        $this->assertEquals('jeden tysiąc piętnaście złotych', $currencyTranslator->convert(1015));
        $this->assertEquals('jeden tysiąc trzynaście złotych', $currencyTranslator->convert(1013));
        $this->assertEquals('jeden tysiąc jedenaście złotych', $currencyTranslator->convert(1011));
        $this->assertEquals('jeden tysiąc dziesięć złotych', $currencyTranslator->convert(1010));
        $this->assertEquals('jeden tysiąc pięć złotych 22/100', $currencyTranslator->convert(1005.22));
        $this->assertEquals('jeden tysiąc dziewięć złotych', $currencyTranslator->convert(1009));
        $this->assertEquals('jeden tysiąc pięć złotych', $currencyTranslator->convert(1005));
        $this->assertEquals('jeden tysiąc trzy złote', $currencyTranslator->convert(1003));
        $this->assertEquals('jeden tysiąc dwa złote', $currencyTranslator->convert(1002));
        $this->assertEquals('jeden tysiąc jeden złotych', $currencyTranslator->convert(1001));
        $this->assertEquals('jeden tysiąc złotych 27/100', $currencyTranslator->convert(1000.27));
        $this->assertEquals('jeden tysiąc złotych', $currencyTranslator->convert(1000));
        $this->assertEquals('dziewięćset dziewięćdziesiąt dziewięć złotych', $currencyTranslator->convert(999));
        $this->assertEquals('osiemset pięćdziesiąt pięć złotych', $currencyTranslator->convert(855));
        $this->assertEquals('siedemset osiemdziesiąt trzy złote', $currencyTranslator->convert(783));
        $this->assertEquals('sześćset dwadzieścia dziewięć złotych', $currencyTranslator->convert(629));
        $this->assertEquals('pięćset sześćdziesiąt jeden złotych', $currencyTranslator->convert(561));
        $this->assertEquals('czterysta czterdzieści cztery złote', $currencyTranslator->convert(444));
        $this->assertEquals('trzysta pięćdziesiąt pięć złotych', $currencyTranslator->convert(355));
        $this->assertEquals('dwieście dziewięćdziesiąt dwa złote', $currencyTranslator->convert(292));
        $this->assertEquals('dwieście trzydzieści osiem złotych', $currencyTranslator->convert(238));
        $this->assertEquals('dwieście jedenaście złotych', $currencyTranslator->convert(211));
        $this->assertEquals('dwieście złotych', $currencyTranslator->convert(200));
        $this->assertEquals('sto dziewięćdziesiąt dziewięć złotych', $currencyTranslator->convert(199));
        $this->assertEquals('sto pięćdziesiąt siedem złotych', $currencyTranslator->convert(157));
        $this->assertEquals('sto dwadzieścia trzy złote', $currencyTranslator->convert(123));
        $this->assertEquals('sto złotych 55/100', $currencyTranslator->convert(100.55));
        $this->assertEquals('sto złotych', $currencyTranslator->convert(100));
        $this->assertEquals('dziewięćdziesiąt trzy złote', $currencyTranslator->convert(93));
        $this->assertEquals('osiemdziesiąt cztery złote', $currencyTranslator->convert(84));
        $this->assertEquals('siedemdziesiąt dwa złote', $currencyTranslator->convert(72));
        $this->assertEquals('sześćdziesiąt pięć złotych', $currencyTranslator->convert(65));
        $this->assertEquals('pięćdziesiąt dziewięć złotych', $currencyTranslator->convert(59));
        $this->assertEquals('czterdzieści osiem złotych', $currencyTranslator->convert(48));
        $this->assertEquals('trzydzieści sześć złotych', $currencyTranslator->convert(36));
        $this->assertEquals('trzydzieści pięć złotych', $currencyTranslator->convert(35));
        $this->assertEquals('trzydzieści cztery złote', $currencyTranslator->convert(34));
    }

    public function testCapitalize(): void
    {
        $currencyTranslator = new CurrencyTranslator(capitalize: true);
        $this->assertEquals('Dwanaście tysięcy pięćset sześćdziesiąt dwa złote 35/100', $currencyTranslator->convert(12562.345));
        $this->assertEquals('Zero złotych 99/100', $currencyTranslator->convert(0.99));
    }

    public function testExceptionsTooSmall(): void
    {
        $currencyTranslator = new CurrencyTranslator();
        $this->assertEquals('jeden tysiąc dwieście dwadzieścia jeden złotych 32/100', $currencyTranslator->convert('1221.32'));
        $this->assertEquals('minus jeden tysiąc dwieście trzydzieści dziewięć złotych 21/100', $currencyTranslator->convert(-1239.21));
        $this->expectException(RuntimeException::class);
        $this->assertEquals('sto milionow trylionow', $currencyTranslator->convert(1000000001));
    }

    public function testExceptionsTooBig(): void
    {
        $currencyTranslator = new CurrencyTranslator();
        $this->assertEquals('minus zero złotych 32/100', $currencyTranslator->convert('-0.32'));
        $this->assertEquals('dziewięćset dziewięćdziesiąt dziewięć milionów dziewięćset dziewięćdziesiąt dziewięć tysięcy dziewięćset dziewięćdziesiąt dziewięć złotych', $currencyTranslator->convert(1000000000 - 1));
        $this->expectException(RuntimeException::class);
        $this->assertEquals('jeden tysiąc dwieście dwadzieścia jeden złotych 32/100', $currencyTranslator->convert(1000000000));
    }

}
