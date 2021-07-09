<?php

declare(strict_types=1);

namespace Grzegab\CurrencyTranslator\Grzegab\Translator;

use JetBrains\PhpStorm\Pure;
use RuntimeException;

class CurrencyTranslator
{
    private bool $showGrosze;
    private bool $capitalize;

    private const GROSZE_ENDING = '/100';
    private const ZERO_RESULT = 'zero złotych';
    private const EMPTY = '';

    private const ZLOTYCH = 'złotych';
    private const ZLOTE = 'złote';

    public function __construct(bool $showGrosze = true, bool $capitalize = false)
    {
        $this->showGrosze = $showGrosze;
        $this->capitalize = $capitalize;
    }

    public function convert(float $amount = 0): string
    {
        $returnString = '';

        /* First verify number */
        $this->verifyAmount($amount);

        if ($amount < 0) {
            $returnString .= 'minus ';
            $amount *= -1;
        }

        /* Strings are easier to work with */
        $amountRounded = sprintf('%.2f', round($amount, 2));

        /* Get both values to work with */
        [$zlotyAmount, $groszyAmount] = $this->divideAmountToZlotyAndGroszy($amountRounded);

        $stringZloty = $this->convertZloty($zlotyAmount);
        $stringGroszy = $this->convertGroszy($groszyAmount);

        $returnString .= $stringZloty;

        if ($this->showGrosze && (int)$stringGroszy !== 0) {
            $returnString .= ' ' . $stringGroszy;
        }

        if ($this->capitalize) {
            $returnString = ucfirst($returnString);
        }

        return $returnString;
    }

    private function glueText(string $baseText, ?string $textToAdd = null, bool $space = true): string
    {
        if (!empty($baseText) && $space) {
            $baseText .= ' ';
        }

        if (!empty($textToAdd)) {
            $baseText .= $textToAdd;
        }

        return $baseText;
    }

    private function verifyAmount(float $amount): void
    {
        if ($amount > 1000000000 - 1) { //too much to handle
            throw new RuntimeException('Amount is to big');
        }
    }

    private function divideAmountToZlotyAndGroszy(string $amount): array
    {
        $amount = ltrim($amount, "0");
        if (str_contains($amount, '.')) {
            $parts = explode('.', $amount);
        } else {
            $parts = [$amount, "0"];
        }

        return $parts;
    }

    private function convertGroszy(string $amount): string
    {
        return $amount . self::GROSZE_ENDING;
    }

    #[Pure]
    private function convertZloty(string $amount): string
    {
        if ((int)$amount === 0) {
            return self::ZERO_RESULT;
        }

        $returnString = '';

        /* Divide into array of 3 for simpler usage */
        $zlotyArray = array_chunk(array_reverse(str_split($amount)), 3);
        $iterationCount = count($zlotyArray) - 1;

        for ($j = $iterationCount; $j >= 0; $j--) {
            //exception if - 13, 14 etc.
            if (!empty($zlotyArray[$j][1]) && !empty($zlotyArray[$j][0]) && $zlotyArray[$j][0] > 0 && (int)$zlotyArray[$j][1] === 1) {
                //if its 213, 413 etc, leading number
                if (!empty($zlotyArray[$j][2])) {
                    $returnString = $this->glueText(
                        $returnString,
                        $this->textTranslationsNumber[2][$zlotyArray[$j][2]]
                    );
                }
                //add exception text
                $returnString = $this->glueText(
                    $returnString,
                    $this->textTranslationsNumberException[$zlotyArray[$j][0]]
                );
            } else { //normal numbers 21, 34 etc.
                //reversed foreach loop
                $countNumbers = count($zlotyArray[$j]) - 1;
                for ($i = $countNumbers; $i >= 0; $i--) {
                    $space = !(((int)$zlotyArray[$j][$i][0] === 0));
                    $returnString = $this->glueText(
                        $returnString,
                        $this->textTranslationsNumber[$i][$zlotyArray[$j][$i]],
                        $space
                    );
                }
            }

            //add extension if needed
            $multiple = (count($zlotyArray[$j]) > 1) ? 1 : 0;
            if (!empty($this->textTranslationExtension[$j][$multiple][$zlotyArray[$j][0]])) {
                $returnString = $this->glueText(
                    $returnString,
                    $this->textTranslationExtension[$j][$multiple][$zlotyArray[$j][0]]
                );
            }
        }

        //add ending
        if (count($zlotyArray[0]) > 1 && !empty($zlotyArray[0][1]) && $zlotyArray[0][0] > 0 && (int)$zlotyArray[0][1] === 1) {
            $returnString = $this->glueText($returnString, $this->textTranslationEndingException);
        } elseif (count($zlotyArray[0]) > 1) {
            $returnString = $this->glueText($returnString, $this->textTranslationEnding[1][$zlotyArray[0][0]]);
        } else {
            $returnString = $this->glueText($returnString, $this->textTranslationEnding[0][$zlotyArray[0][0]]);
        }

        return $returnString;
    }

    private array $textTranslationsNumber = [
        0 => [
            0 => self::EMPTY, // jedności
            1 => 'jeden',
            2 => 'dwa',
            3 => 'trzy',
            4 => 'cztery',
            5 => 'pięć',
            6 => 'sześć',
            7 => 'siedem',
            8 => 'osiem',
            9 => 'dziewięć'
        ],
        1 => [
            0 => self::EMPTY, //dziesiątki
            1 => 'dziesięć',
            2 => 'dwadzieścia',
            3 => 'trzydzieści',
            4 => 'czterdzieści',
            5 => 'pięćdziesiąt',
            6 => 'sześćdziesiąt',
            7 => 'siedemdziesiąt',
            8 => 'osiemdziesiąt',
            9 => 'dziewięćdziesiąt'
        ],
        2 => [
            0 => self::EMPTY, // setki
            1 => 'sto',
            2 => 'dwieście',
            3 => 'trzysta',
            4 => 'czterysta',
            5 => 'pięćset',
            6 => 'sześćset',
            7 => 'siedemset',
            8 => 'osiemset',
            9 => 'dziewięćset'
        ]
    ];

    private array $textTranslationsNumberException = [
        0 => self::EMPTY,
        1 => 'jedenaście',
        2 => 'dwanaście',
        3 => 'trzynaście',
        4 => 'czternaście',
        5 => 'piętnaście',
        6 => 'szesnaście',
        7 => 'siedemnaście',
        8 => 'osiemnaście',
        9 => 'dziewiętnaście'
    ];

    private array $textTranslationExtension =
        [
            0 =>
                [
                    0 => self::EMPTY,
                    1 => self::EMPTY,
                    2 => self::EMPTY,
                    3 => self::EMPTY,
                    4 => self::EMPTY,
                    5 => self::EMPTY,
                    6 => self::EMPTY,
                    7 => self::EMPTY,
                    8 => self::EMPTY,
                    9 => self::EMPTY
                ],
            1 =>
                [
                    0 =>
                        [
                            0 => self::EMPTY,
                            1 => 'tysiąc',
                            2 => 'tysiące',
                            3 => 'tysiące',
                            4 => 'tysiące',
                            5 => 'tysięcy',
                            6 => 'tysięcy',
                            7 => 'tysięcy',
                            8 => 'tysięcy',
                            9 => 'tysięcy'
                        ],
                    1 =>
                        [
                            0 => 'tysięcy',
                            1 => 'tysięcy',
                            2 => 'tysięcy',
                            3 => 'tysięcy',
                            4 => 'tysięcy',
                            5 => 'tysięcy',
                            6 => 'tysięcy',
                            7 => 'tysięcy',
                            8 => 'tysięcy',
                            9 => 'tysięcy'
                        ]
                ],
            2 =>
                [
                    0 =>
                        [
                            0 => self::EMPTY,
                            1 => 'milion',
                            2 => 'miliony',
                            3 => 'miliony',
                            4 => 'miliony',
                            5 => 'milionów',
                            6 => 'milionów',
                            7 => 'milionów',
                            8 => 'milionów',
                            9 => 'milionów'
                        ],
                    1 =>
                        [
                            0 => 'milionów',
                            1 => 'milionów',
                            2 => 'miliony',
                            3 => 'miliony',
                            4 => 'miliony',
                            5 => 'milionów',
                            6 => 'milionów',
                            7 => 'milionów',
                            8 => 'milionów',
                            9 => 'milionów'
                        ]
                ],
        ];

    private $textTranslationEnding = [
        0 =>
            [
                0 => self::ZLOTYCH,
                1 => 'złoty',
                2 => self::ZLOTE,
                3 => self::ZLOTE,
                4 => self::ZLOTE,
                5 => self::ZLOTYCH,
                6 => self::ZLOTYCH,
                7 => self::ZLOTYCH,
                8 => self::ZLOTYCH,
                9 => self::ZLOTYCH
            ],
        1 =>
            [
                0 => self::ZLOTYCH,
                1 => self::ZLOTYCH,
                2 => self::ZLOTE,
                3 => self::ZLOTE,
                4 => self::ZLOTE,
                5 => self::ZLOTYCH,
                6 => self::ZLOTYCH,
                7 => self::ZLOTYCH,
                8 => self::ZLOTYCH,
                9 => self::ZLOTYCH
            ],
        2 =>
            [
                0 => self::ZLOTYCH,
                1 => self::ZLOTYCH,
                2 => self::ZLOTYCH,
                3 => self::ZLOTYCH,
                4 => self::ZLOTYCH,
                5 => self::ZLOTYCH,
                6 => self::ZLOTYCH,
                7 => self::ZLOTYCH,
                8 => self::ZLOTYCH,
                9 => self::ZLOTYCH
            ]
    ];

    private string $textTranslationEndingException = self::ZLOTYCH;
}