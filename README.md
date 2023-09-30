# Easy type control for static analysis

[![Latest Version on Packagist](https://img.shields.io/packagist/v/smpita/typeas.svg?style=flat-square)](https://packagist.org/packages/smpita/typeas)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/smpita/typeas/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/smpita/typeas/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/smpita/typeas/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/smpita/typeas/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/smpita/typeas.svg?style=flat-square)](https://packagist.org/packages/smpita/typeas)

- Do you fight `mixed` signatures when performing static analysis?

[TypeAs](https://github.com/smpita/typeas) will help you keep tight control of your typing.

## Installation

You can install the package via composer:

```bash
composer require smpita/typeas
```

## Usage

Generally, you just pass the mixed and it will throw a `TypeAsResolutionException` if the `$mixed` can't be cast.
```php
$typed = Smpita\TypeAs::string($mixed);
```

If you want to suppress throwing exceptions, provide a default.
```php
$typed = Smpita\TypeAs::string($mixed, '');
```

Class has a slightly different signature because you have to specify the class you want.
```php
$typed = Smpita\TypeAs::class($mixed, Target::class);
```

You can still provide a default.
```php
$typed = Smpita\TypeAs::class($mixed, Target::class, new \StdClass);
```

By default, `array()` will it wrap the value similar to `(array) $mixed` instead of throwing exceptions.
```php
Smpita\TypeAs::array('example') === ['example'];
```

That might not always be appropriate, so you can turn wrapping off to get exceptions.
```php
$typed = Smpita\TypeAs::array($mixed, false);
```

Or you may supply a default.
```php
$typed = Smpita\TypeAs::array($mixed, []);
```

## Signatures

#### Arrays
```php
Smpita\TypeAs::array(mixed $value): array
```

#### Carbon
```php
Smpita\TypeAs::carbon(mixed $value, DateTimeZone|string|null $tz = null, Carbon $default = null): Carbon
```

#### Classes
```php
Smpita\TypeAs::class(mixed $value, string $class, object $default = null): object
```

#### Floats
```php
Smpita\TypeAs::float(mixed $value, float $default = null): float
```

#### Integers
```php
Smpita\TypeAs::int(mixed $value, int $default = null): int
```

#### Strings
```php
Smpita\TypeAs::string(mixed $value, string $default = null): string
```

## Testing
```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Sean Pearce](https://github.com/smpita)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
