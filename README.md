<div align="center">

# Guaranteed type control for PHP
Easily type your `mixed` signatures. Perfect for static analysis!

[![Total Downloads](https://img.shields.io/packagist/dt/smpita/typeas.svg?style=flat-square)](https://packagist.org/packages/smpita/typeas)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/smpita/typeas.svg?style=flat-square)](https://packagist.org/packages/smpita/typeas)
[![License](https://img.shields.io/packagist/l/smpita/typeas.svg?style=flat-square)](https://packagist.org/packages/smpita/typeas)

[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/smpita/typeas/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/smpita/typeas/actions?query=workflow%3Arun-tests+branch%3Amain)
[![Coverage Status](https://coveralls.io/repos/github/smpita/typeas/badge.svg)](https://coveralls.io/github/smpita/typeas)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/smpita/typeas/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/smpita/typeas/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)

[![FOSSA Status](https://app.fossa.com/api/projects/git%2Bgithub.com%2Fsmpita%2Ftypeas.svg?type=shield&issueType=security)](https://app.fossa.com/projects/git%2Bgithub.com%2Fsmpita%2Ftypeas?ref=badge_shield&issueType=security)
[![FOSSA Status](https://app.fossa.com/api/projects/git%2Bgithub.com%2Fsmpita%2Ftypeas.svg?type=shield&issueType=license)](https://app.fossa.com/projects/git%2Bgithub.com%2Fsmpita%2Ftypeas?ref=badge_shield&issueType=license)

</div>

---

## Table of Contents
- [Quick Start](#quick-start)
  - [Installation](#installation)
  - [Resolving Types](#resolving-types)
  - [Caveats](#caveats)
  - [Custom Resolvers](#custom-resolvers)
  - [Helpers](#helpers)
- [Deprecations](#deprecations)
- [Testing](#testing)
- [Changelog](#changelog)
- [Contributing](#contributing)
- [Security Vulnerabilities](#security-vulnerabilities)
- [Credits](#credits)
- [License](#license)

---

## Quick Start

### Installation

Install the package via composer:

```bash
composer require smpita/typeas
```

See [SIGNATURES](docs/signatures.md) for the full list of methods and signatures.

### Resolving types

[SIGNATURES#resolving](docs/signatures.md#resolving)

Pass a mixed variable to get a typed variable.

```php
use Smpita\TypeAs\TypeAs;

// Throws \Smpita\TypeAs\TypeAsResolutionException if $mixed can't resolve to the type.
$array = TypeAs::array($mixed);
$bool = TypeAs::bool($mixed);
$class = TypeAs::class(Expected::class, $mixed);
$float = TypeAs::float($mixed);
$int = TypeAs::int($mixed);
$string = TypeAs::string($mixed);

// Returns null if $mixed can't resolve to the type.
$nullableArray = TypeAs::nullableArray($mixed);
$nullableBool = TypeAs::nullableBool($mixed);
$nullableClass = TypeAs::nullableClass(Expected::class, $mixed);
$nullableFloat = TypeAs::nullableFloat($mixed);
$nullableInt = TypeAs::nullableInt($mixed);
$nullableString = TypeAs::nullableString($mixed);
```

To suppress throwing exceptions, provide a default.

```php
use Smpita\TypeAs\TypeAs;

// Returns the default if passed null, or if $mixed can't resolve to the type.
$array = TypeAs::array($mixed, []);
$bool = TypeAs::bool($mixed, false);
$class = TypeAs::class(Expected::class, $mixed, new StdClass());
$float = TypeAs::float($mixed, 0.0);
$int = TypeAs::int($mixed, 0);
$string = TypeAs::string($mixed, '');

// Nullable types can specify defaults.
$nullableArray = TypeAs::nullableArray($mixed, []);
$nullableBool = TypeAs::nullableBool($mixed, false);
$nullableClass = TypeAs::nullableClass(Expected::class, $mixed, new StdClass());
$nullableFloat = TypeAs::nullableFloat($mixed, 0.0);
$nullableInt = TypeAs::nullableInt($mixed, 0);
$nullableString = TypeAs::nullableString($mixed, '');
```

### Caveats

[SIGNATURES#array](docs/signatures.md#array)

By default, `array()` will wrap non-iterables similar to `(array) $mixed` instead of throwing exceptions.

```php
use Smpita\TypeAs\TypeAs;

TypeAs::array('example'); // returns ['example']
TypeAs::array(['example']); // returns ['example']
```

Wrapping might not always be appropriate. Turn wrapping off to get exceptions.

```php
use Smpita\TypeAs\TypeAs;

$typed = TypeAs::array($mixed, false);
```

---

## Custom Resolvers

[SIGNATURES#resolver-registration](docs/signatures.md#resolver-registration)

Starting in `v2.4.0` you can specify your own custom resolvers.

Each type has an associated interface located in `Smpita\TypeAs\Contracts` which you can implement to make your own resolvers.

Simply implement the interface, then either register the resolver or use it in the resolver method.

### Interfaces

-   `Smpita\TypeAs\Contracts\ArrayResolver`
-   `Smpita\TypeAs\Contracts\BoolResolver`
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
TypeAs::setStringResolver(new CustomStringResolver());
TypeAs::setNullableStringResolver(new CustomNullableStringResolver());
```

#### Single use

```php
$typed = Smpita\TypeAs::string($mixed, null, new CustomStringResolver());
```

### Unregistering Custom Resolvers

To return to default, set the resolver to `null`.

```php
TypeAs::setStringResolver(null);
```

To return all resolvers to default, you can leverage the `useDefaultResolvers()`.

```php
TypeAs::useDefaultResolvers();
```

If you registered a custom resolver and want to use the default resolver on a single use basis, passing `null` to the resolver method will not work. You must pass the default resolver.

```php
$typed = Smpita\TypeAs::string($mixed, null, new \Smpita\TypeAs\Resolvers\AsString());
```

---

## Helpers

[SIGNATURES#helpers](docs/signatures.md#helpers)

Starting in `v2.5.0` resolver methods have an associated helper method located in the `Smpita\TypeAs` namespace.
The helper method names follow the `TypeAs` method names, but are prepended by `as` and are **camelCased**.

```php
use function Smpita\TypeAs\asString;

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


[![FOSSA Status](https://app.fossa.com/api/projects/git%2Bgithub.com%2Fsmpita%2Ftypeas.svg?type=large)](https://app.fossa.com/projects/git%2Bgithub.com%2Fsmpita%2Ftypeas?ref=badge_large)
