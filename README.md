# Easy type control for static analysis

[![Latest Version on Packagist](https://img.shields.io/packagist/v/smpita/typeas.svg?style=flat-square)](https://packagist.org/packages/smpita/typeas)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/smpita/typeas/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/smpita/typeas/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/smpita/typeas/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/smpita/typeas/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/smpita/typeas.svg?style=flat-square)](https://packagist.org/packages/smpita/typeas)

Do you fight `mixed` signatures when performing static analysis?

[Smpita/TypeAs](https://github.com/smpita/typeas) will give you easy control of your typing.

## Installation

You can install the package via composer:

```bash
composer require smpita/typeas
```

---

## Usage

### General Usage

Pass a `$mixed` and it will throw a `TypeAsResolutionException` if the `$mixed` can't be cast.

```php
$typed = Smpita\TypeAs::string($mixed);
```

If you want to suppress throwing exceptions, provide a default.

```php
$typed = Smpita\TypeAs::string($mixed, '');
```

### The Class Method

`class()` has a slightly different signature because you need to specify the class you are expecting.

```php
$typed = Smpita\TypeAs::class(Target::class, $mixed);
```

You can still provide a default.

```php
$typed = Smpita\TypeAs::class(Target::class, $mixed, new \StdClass);
```

Note: In versions prior to `v2.0.0` the signature had a different order.

```php
$typed = Smpita\TypeAs::class($mixed, Target::class, $default);
```

### The Array Method

By default, `array()` will wrap non-iterables similar to `(array) $mixed` instead of throwing exceptions.

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

---

## Nullables

Starting in `v2.2.0` if you would prefer to receive `null` instead of having an exception thrown, each type method has a nullable counterpart.

```php
Smpita\TypeAs::nullableCarbon('invalid-timestamp') === null
```

## Methods

#### Array

```php
Smpita\TypeAs::array(mixed $value, bool|array $wrap = true): array
```

```php
Smpita\TypeAs::nullableArray(mixed $value, bool|array $wrap = true): ?array
```

#### Carbon

```php
Smpita\TypeAs::carbon(mixed $value, DateTimeZone|string|null $tz = null, Carbon $default = null): Carbon
```

```php
Smpita\TypeAs::nullableCarbon(mixed $value, DateTimeZone|string|null $tz = null, Carbon $default = null): ?Carbon
```

#### Class

```php
Smpita\TypeAs::class(string $class, mixed $value, object $default = null): object
```

```php
Smpita\TypeAs::nullableClass(string $class, mixed $value, object $default = null): ?object
```

#### Float

```php
Smpita\TypeAs::float(mixed $value, float $default = null): float
```

```php
Smpita\TypeAs::nullableFloat(mixed $value, float $default = null): ?float
```

#### Integer

```php
Smpita\TypeAs::int(mixed $value, int $default = null): int
```

```php
Smpita\TypeAs::nullableInt(mixed $value, int $default = null): ?int
```

#### String

```php
Smpita\TypeAs::string(mixed $value, string $default = null): string
```

```php
Smpita\TypeAs::nullableString(mixed $value, string $default = null): ?string
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

-   [Sean Pearce](https://github.com/smpita)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
