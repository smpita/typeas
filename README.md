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

Please see [SIGNATURES](docs/signatures.md) for the list of current methods and signatures.

### General Usage

[SIGNATURES#resolving](docs/signatures.md#resolving)

Pass a `$mixed` and it will throw a `TypeAsResolutionException` if the `$mixed` can't be cast.

```php
use Smpita\TypeAs\TypeAs;

$typed = TypeAs::string($mixed);
```

If you want to suppress throwing exceptions, provide a default.

```php
use Smpita\TypeAs\TypeAs;

$typed = TypeAs::string($mixed, '');
```

### The Class Method

[SIGNATURES#class](docs/signatures.md#class)

`class()` has a slightly different signature because you need to specify the class you are expecting.

```php
use Smpita\TypeAs\TypeAs;

$typed = TypeAs::class(Target::class, $mixed);
```

You can still provide a default.

```php
use Smpita\TypeAs\TypeAs;

$typed = TypeAs::class(Target::class, $mixed, new \StdClass);
```

Note: In versions prior to `v2.0.0` the signature had a different order.

```php
use Smpita\TypeAs\TypeAs;

$typed = TypeAs::class($mixed, Target::class, $default);
```

### The Array Method

[SIGNATURES#array](docs/signatures.md#array)

By default, `array()` will wrap non-iterables similar to `(array) $mixed` instead of throwing exceptions.

```php
use Smpita\TypeAs\TypeAs;

TypeAs::array('example') === ['example'];
```

That might not always be appropriate, so you can turn wrapping off to get exceptions.

```php
use Smpita\TypeAs\TypeAs;

$typed = TypeAs::array($mixed, false);
```

Or you may supply a default.

```php
use Smpita\TypeAs\TypeAs;

$typed = TypeAs::array($mixed, []);
```

---

## Nullables

Starting in `v2.3.0` if you would prefer to receive `null` instead of having an exception thrown, each type method has a nullable counterpart.

```php
use Smpita\TypeAs\TypeAs;

TypeAs::nullableString(new \stdClass) === null
```

---

## Resolvers

[SIGNATURES#resolver-registration](docs/signatures.md#resolver-registration)

Starting in `v2.4.0` you can specify your own custom resolvers.

Each type has an associated interface located in `Smpita\TypeAs\Contracts` which you can implement to make your own resolvers.

Simply implement the interface, then either register the resolver or use it in the resolver method.

### Interfaces

-   `Smpita\TypeAs\Contracts\ArrayResolver`
-   `Smpita\TypeAs\Contracts\ClassResolver`
-   `Smpita\TypeAs\Contracts\FloatResolver`
-   `Smpita\TypeAs\Contracts\IntResolver`
-   `Smpita\TypeAs\Contracts\NullableArrayResolver`
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

## Helpers

[SIGNATURES#helpers](docs/signatures.md#helpers)

Starting in `v2.5.0` resolver methods have an associated helper method located in the `Smpita\TypeAs` namespace.
The helper method names follow the `TypeAs` method names, but are prepended by `as` and are **camelCased**.

```php
use Smpita\TypeAs\asString;

$typed = asString($mixed);
```

---

## Deprecations

[SIGNATURES#deprecations](docs/signatures.md#deprecations)

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
