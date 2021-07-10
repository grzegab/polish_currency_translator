# Currency translator
This package allows translating number into text for Polish notation.

##Usage
Install with composer
Use in class: `use Grzegab\CurrencyTranslator\CurrencyTranslator;`
Translate text:
```php
use Grzegab\CurrencyTranslator\CurrencyTranslator;

$translator = new CurrencyTranslator();
$currencyString = $translator->convert(1235.22);
```
### Options
While creating translator you can choose if you want to have only full numbers
```injectablephp
use Grzegab\CurrencyTranslator\CurrencyTranslator;

$translator = new CurrencyTranslator(showGrosze: false);
```
Or To have first letter capitalized:
```injectablephp
use Grzegab\CurrencyTranslator\CurrencyTranslator;

$translator = new CurrencyTranslator(capitalize: false);
```

## Test app
```injectablephp
use Grzegab\CurrencyTranslator\CurrencyTranslator;

$valueBig = random_int(1, 999999);
$valueSmall = random_int(1, 99) / 100;
$value = $valueBig + $valueSmall;

$translator = new CurrencyTranslator(capitalize: true);
$currencyString = $translator->convert($value);
```

## Bugs
For any bugs or questions contact me by github: [https://github.com/grzegab/polish_currency_translator](https://github.com/grzegab/polish_currency_translator)