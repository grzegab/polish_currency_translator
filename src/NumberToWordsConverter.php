<?php

declare(strict_types=1);

namespace Grzegab\CurrencyTranslator;

class NumberToWordsConverter
{
    public const ZLOTYCH_TEXT = 'złotych';
    public const ZLOTE_TEXT = 'złote';

    public const array HUNDRETS_MAP = [
        1 => 'sto',
        2 => 'dwieście',
        3 => 'trzysta',
        4 => 'czterysta',
        5 => 'pięćset',
        6 => 'sześćset',
        7 => 'siedemset',
        8 => 'osiemset',
        9 => 'dziewięćset'
    ];

    public const array TENTHS_MAP = [
        1 => 'dziesięć',
        2 => 'dwadzieścia',
        3 => 'trzydzieści',
        4 => 'czterdzieści',
        5 => 'pięćdziesiąt',
        6 => 'sześćdziesiąt',
        7 => 'siedemdziesiąt',
        8 => 'osiemdziesiąt',
        9 => 'dziewięćdziesiąt'
    ];

    public const array TENTHS_SINGLE_MAP = [
        0 => 'dziesięć',
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

    public const array SINGLE_MAP = [
        0 => 'zero',
        1 => 'jeden',
        2 => 'dwa',
        3 => 'trzy',
        4 => 'cztery',
        5 => 'pięć',
        6 => 'sześć',
        7 => 'siedem',
        8 => 'osiem',
        9 => 'dziewięć'
    ];

    public const array ENDINGS_MAP = [
        0 => [
            0 => self::ZLOTYCH_TEXT,
            1 => self::ZLOTYCH_TEXT,
            2 => self::ZLOTE_TEXT,
            3 => self::ZLOTE_TEXT,
            4 => self::ZLOTE_TEXT,
            5 => self::ZLOTYCH_TEXT,
            6 => self::ZLOTYCH_TEXT,
            7 => self::ZLOTYCH_TEXT,
            8 => self::ZLOTYCH_TEXT,
            9 => self::ZLOTYCH_TEXT
        ],
        1 => [
            0 => 'tysięcy',
            1 => 'tysięcy',
            2 => 'tysiące',
            3 => 'tysiące',
            4 => 'tysiące',
            5 => 'tysięcy',
            6 => 'tysięcy',
            7 => 'tysięcy',
            8 => 'tysięcy',
            9 => 'tysięcy'
        ],
        2 => [
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
        ],
    ];

    public const array ENDINGS_EXCEPTION_MAP = [
        0 =>  self::ZLOTYCH_TEXT,
        1 => 'tysięcy',
        2 => 'milionów',
    ];

    public const array ENDINGS_SINGLE_EXCEPTION_MAP = [
        0 =>
            [
                0 => self::ZLOTYCH_TEXT,
                1 => self::ZLOTYCH_TEXT,
                2 => self::ZLOTE_TEXT,
                3 => self::ZLOTE_TEXT,
                4 => self::ZLOTE_TEXT,
                5 => self::ZLOTYCH_TEXT,
                6 => self::ZLOTYCH_TEXT,
                7 => self::ZLOTYCH_TEXT,
                8 => self::ZLOTYCH_TEXT,
                9 => self::ZLOTYCH_TEXT
            ],
        1 => [
            0 => 'tysiąc',
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
        2 => [
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
        ],
    ];

    public const array ENDINGS_MULTIPLE_EXCEPTION_MAP = [
        0 =>
            [
                0 => self::ZLOTYCH_TEXT,
                1 => self::ZLOTYCH_TEXT,
                2 => self::ZLOTE_TEXT,
                3 => self::ZLOTE_TEXT,
                4 => self::ZLOTE_TEXT,
                5 => self::ZLOTYCH_TEXT,
                6 => self::ZLOTYCH_TEXT,
                7 => self::ZLOTYCH_TEXT,
                8 => self::ZLOTYCH_TEXT,
                9 => self::ZLOTYCH_TEXT
            ],
        1 => [
            0 => 'tysięcy',
            1 => 'tysięcy',
            2 => 'tysiące',
            3 => 'tysiące',
            4 => 'tysiące',
            5 => 'tysięcy',
            6 => 'tysięcy',
            7 => 'tysięcy',
            8 => 'tysięcy',
            9 => 'tysięcy'
        ],
        2 => [
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
        ],
    ];
}