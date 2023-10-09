# Easy type control for static analysis

[![Latest Version on Packagist](https://img.shields.io/packagist/v/smpita/typeas.svg?style=flat-square)](https://packagist.org/packages/smpita/typeas)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/smpita/typeas/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/smpita/typeas/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/smpita/typeas/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/smpita/typeas/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/smpita/typeas.svg?style=flat-square)](https://packagist.org/packages/smpita/typeas)

Do you fight `mixed` signatures when performing static analysis?

## [Smpita/TypeAs](https://github.com/smpita/typeas) will give you easy control of your typing.

---

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

Starting in `v2.3.0` if you would prefer to receive `null` instead of having an exception thrown, each type method has a nullable counterpart.

```php
Smpita\TypeAs::nullableCarbon('invalid-timestamp') === null
```

---

## Resolvers

Starting in `v2.4.0` you can specify your own custom resolvers.

Each type has an associated interface located in `Smpita\TypeAs\Contracts` which you can implement to make your own resolvers.

Simply implement the interface, then either register the resolver or use it in the resolver method.

### Interfaces

-   `Smpita\TypeAs\Contracts\ArrayResolver`
-   `Smpita\TypeAs\Contracts\CarbonResolver`
-   `Smpita\TypeAs\Contracts\ClassResolver`
-   `Smpita\TypeAs\Contracts\FloatResolver`
-   `Smpita\TypeAs\Contracts\IntResolver`
-   `Smpita\TypeAs\Contracts\NullableArrayResolver`
-   `Smpita\TypeAs\Contracts\NullableCarbonResolver`
-   `Smpita\TypeAs\Contracts\NullableClassResolver`
-   `Smpita\TypeAs\Contracts\NullableFloatResolver`
-   `Smpita\TypeAs\Contracts\NullableIntResolver`
-   `Smpita\TypeAs\Contracts\NullableStringResolver`
-   `Smpita\TypeAs\Contracts\StringResolver`

### Creating Custom Resolvers

```php
use Smpita\TypeAs\Contracts\StringResolver;

class CustomStringResolver implements StringResolver
{
    /**
     * @throws \UnexpectedValueException
     */
    public function resolve(mixed $value, string $default = null): string
    {
        // Your logic here
    }
}
```

### Registering Custom Resolvers

#### Globally

To globally register a resolver, use the associated setter method. In Laravel, it's recommended to do this in the boot method of a `ServiceProvider`.

```php
TypeAs::setStringResolver(new CustomStringResolver);
```

#### Single use

```php
$typed = Smpita\TypeAs::string($mixed, null, new CustomStringResolver);
```

### Unregistering Custom Resolvers

To return to default, simply set the resolver to `null`.

```php
TypeAs::setStringResolver(null);
```

To return all resolvers to default, you can leverage the `useDefaultResolvers()`.

```php
TypeAs::useDefaultResolvers();
```

If you registered a custom resolver and want to use the default resolver on a single use basis, passing `null` to the resolver method will not work. You must pass the default resolver.

```php
$typed = Smpita\TypeAs::string($mixed, null, new \Smpita\TypeAs\Resolvers\AsString);
```

---

## Methods

### Resolving

#### Array

```php
Smpita\TypeAs::array(mixed $value, bool|array $wrap = true, ArrayResolver $resolver = null): array
```

```php
Smpita\TypeAs::nullableArray(mixed $value, bool|array $wrap = true, NullableArrayResolver $resolver = null): ?array
```

#### Carbon

```php
Smpita\TypeAs::carbon(mixed $value, DateTimeZone|string|null $tz = null, Carbon $default = null, CarbonResolver $resolver = null): Carbon
```

```php
Smpita\TypeAs::nullableCarbon(mixed $value, DateTimeZone|string|null $tz = null, Carbon $default = null, NullableCarbonResolver $resolver = null): ?Carbon
```

#### Class

```php
Smpita\TypeAs::class(string $class, mixed $value, object $default = null, ClassResolver $resolver = null): object
```

```php
Smpita\TypeAs::nullableClass(string $class, mixed $value, object $default = null, NullableClassResolver $resolver = null): ?object
```

#### Float

```php
Smpita\TypeAs::float(mixed $value, float $default = null, FloatResolver $resolver = null): float
```

```php
Smpita\TypeAs::nullableFloat(mixed $value, float $default = null, NullableFloatResolver $resolver = null): ?float
```

#### Integer

```php
Smpita\TypeAs::int(mixed $value, int $default = null, IntResolver $resolver = null): int
```

```php
Smpita\TypeAs::nullableInt(mixed $value, int $default = null, NullableIntResolver $resolver = null): ?int
```

#### String

```php
Smpita\TypeAs::string(mixed $value, string $default = null, StringResolver $resolver = null): string
```

```php
Smpita\TypeAs::nullableString(mixed $value, string $default = null, NullableStringResolver $resolver = null): ?string
```

### Resolver registration

```php
Smpita\TypeAs::useDefaultResolvers(): void
```

```php
Smpita\TypeAs::setArrayResolver(?\Smpita\TypeAs\Contracts\ArrayResolver $resolver): void
```

```php
Smpita\TypeAs::setCarbonResolver(?\Smpita\TypeAs\Contracts\CarbonResolver $resolver): void
```

```php
Smpita\TypeAs::setClassResolver(?\Smpita\TypeAs\Contracts\ClassResolver $resolver): void
```

```php
Smpita\TypeAs::setFloatResolver(?\Smpita\TypeAs\Contracts\FloatResolver $resolver): void
```

```php
Smpita\TypeAs::setIntResolver(?\Smpita\TypeAs\Contracts\IntResolver $resolver): void
```

```php
Smpita\TypeAs::setNullableArrayResolver(?\Smpita\TypeAs\Contracts\NullableArrayResolver $resolver): void
```

```php
Smpita\TypeAs::setNullableCarbonResolver(?\Smpita\TypeAs\Contracts\NullableCarbonResolver $resolver): void
```

```php
Smpita\TypeAs::setNullableClassResolver(?\Smpita\TypeAs\Contracts\NullableClassResolver $resolver): void
```

```php
Smpita\TypeAs::setNullableFloatResolver(?\Smpita\TypeAs\Contracts\NullableFloatResolver $resolver): void
```

```php
Smpita\TypeAs::setNullableIntResolver(?\Smpita\TypeAs\Contracts\NullableIntResolver $resolver): void
```

```php
Smpita\TypeAs::setNullableStringResolver(?\Smpita\TypeAs\Contracts\NullableStringResolver $resolver): void
```

```php
Smpita\TypeAs::setStringResolver(?\Smpita\TypeAs\Contracts\StringResolver $resolver): void
```

---

## Testing

```bash
composer test
```

---

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
