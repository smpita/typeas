# Typed Container Resolver for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/smpita/typeas.svg?style=flat-square)](https://packagist.org/packages/smpita/typeas)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/smpita/typeas/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/smpita/typeas/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/smpita/typeas/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/smpita/typeas/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/smpita/typeas.svg?style=flat-square)](https://packagist.org/packages/smpita/typeas)

- Do you fight the `mixed` signature of `app()->make()` when resolving objects?
- Do you want to effortlessly guarantee the resolved object is the expected object? 
- Do you use static analysis on your [Laravel](https://laravel.com/) app?

[TypeAs](https://github.com/smpita/typeas) will make sure you make the object you expect, and nicely type the return for static analysis.

## Installation

You can install the package via composer:

```bash
composer require smpita/typeas
```

## Usage

Generally, you just pass the mixed and it will throw a `TypeAsResolutionException` if the `$mixed` can't be cast.
```php
$typed = Smpita\MakeAs::string($mixed);
```

If you want to suppress throwing exceptions, provide a default.
```php
$typed = Smpita\MakeAs::string($mixed, '');
```

Class has a slightly different signature because you have to specify the class you want.
```php
$typed = Smpita\MakeAs::class($mixed, Target::class);
```

You can still provide a default.
```php
$typed = Smpita\MakeAs::class($mixed, Target::class, new \StdClass);
```

Array doesn't have defaults and never throws an exceptions, it'll just wrap the value.
```php
Smpita\MakeAs::array('example') === ['example'];
```

## Signatures

#### Arrays
```php
array(mixed $value): array
```

#### Carbon
```php
carbon(mixed $value, DateTimeZone|string|null $tz = null, Carbon $default = null): Carbon
```

#### Classes
```php
class(mixed $value, string $class, object $default = null): object
```

#### Floats
```php
float(mixed $value, float $default = null): float
```

#### Integers
```php
int(mixed $value, int $default = null): int
```

#### Strings
```php
string(mixed $value, string $default = null): string
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
