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
  - [Fluent Syntax](#fluent-syntax)
  - [Array Wrapping](#array-wrapping)
  - [Custom Exceptions](#custom-exceptions)
  - [Official Extensions](#official-extensions)
  - [Custom Resolvers](#custom-resolvers)
  - [Helpers](#helpers)
- [Upgrade Guide](docs/upgrading.md)
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

### Defaults

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

// As a named parameter
$array = TypeAs::array(value: $mixed, default: []);
```

### Array Wrapping

[SIGNATURES#array](docs/signatures.md#array)

By default, `array()` will wrap non-iterables similar to `(array) $mixed` instead of throwing exceptions.

```php
use Smpita\TypeAs\TypeAs;

TypeAs::array('example'); // returns ['example']
TypeAs::array(['example']); // returns ['example']

/**
 * Disable array wrapping to get exceptions.
 * These throw \Smpita\TypeAs\TypeAsResolutionException
 */
TypeAs::array('example', wrap: false);
TypeAs::array('example', null, null, false);
```

---

## Fluent Syntax

As a convenience, TypeAs supports fluent syntax.
The `NonNullable` and `Nullable` fluent classes wrap the base TypeAs methods.
In performance critical environments, the [standard methods](#resolving-types) are recommended.

### Basic Usage

```php
use Smpita\TypeAs\TypeAs;

$array = TypeAs::type($mixed)->asArray();
$bool = TypeAs::type($mixed)->asBool();
$filterBool = TypeAs::type($mixed)->asFilterBool()
$class = TypeAs::type($mixed)->asClass(Expected::class);
$float = TypeAs::type($mixed)->asFloat();
$int = TypeAs::type($mixed)->asInt();
$string = TypeAs::type($mixed)->asString();
```

### Nullable

Chain `nullable()` for nullable returns.

Note: Moving between `NonNullable` and `Nullable` returns a new instance of the associated class.

```php
use Smpita\TypeAs\TypeAs;

$nullableArray = TypeAs::type($mixed)
    ->nullable()
    ->asArray();
```

```php
use Smpita\TypeAs\TypeAs;

$array = $typeAsNullableInstance
    ->nonNullable()
    ->asArray();
```

### Custom Resolver

Chain `using()` to resolve using a [Custom Resolver](#custom-resolvers).

```php
use Smpita\TypeAs\TypeAs;

$array = TypeAs::type($mixed)
    ->using(new CustomArrayResolver())
    ->asArray();
```

### Defaults

Chain `default()` to specify a default.

```php
use Smpita\TypeAs\TypeAs;

$array = TypeAs::type($mixed)
    ->default([])
    ->asArray();
```

### Wrapping

```php
TypeAs::type('')->noWrap()->asArray();
TypeAs::type('')->wrap(false)->asArray();
```

### Copying

```php
use Smpita\TypeAs\TypeAs;

$instance = TypeAs::type($mixed);

$assignment = $instance; // $assignment mutates when $instance changes.
$copy = $instance->copy(); // $copy is unaffected by changes to $instance.
$clone = clone $instance; // $clone is unaffected by changes to $instance.
```

### Accessing the config

```php
use Smpita\TypeAs\Fluent\Nullable;
use Smpita\TypeAs\Fluent\NonNullable;

// Returns \Smpita\TypeAs\Fluent\TypeConfig
$config = NonNullable::make()->config();
$config = Nullable::make()->config();
```

### Importing a config

```php
use Smpita\TypeAs\Fluent\Nullable;
use Smpita\TypeAs\Fluent\NonNullable;
use Smpita\TypeAs\Fluent\TypeConfig;

$config = new TypeConfig(
    fromValue: $mixed,
    defaultTo: $default,
    resolveUsing: $resolver,
    arrayWrap: null,
);

$nonNullable = NonNullable::make($config);
$nonNullable = (new NonNullable())->import($config);

$nullable = Nullable::make($config);
$nullable = (new Nullable())->import($config);
```
---
### Custom Exceptions

Use `onError()` to customize the throw message or exception:

```php
use Smpita\TypeAs\TypeAs;

// Global configuration
TypeAs::onError('Expected iterable, received %s', InvalidValueException::class)
    ->array($mixed, $default);

// Fluent API
TypeAs::type($mixed)
    ->onError('Expected array, got %s')
    ->asArray();
```
---

## Extensions

Extensions are created by passing a custom resolver to a function.

### Official Extensions

```php
 /**
  * @see \Smpita\TypeAs\Resolvers\Extensions\AsNullableFilterBool
  *
  * Uses FILTER_VALIDATE_BOOL
  * https://www.php.net/manual/en/filter.constants.php#constant.filter-validate-bool
  *
  * Returns true  on 1 1.0 "1" "true"  "yes" "on"
  * Returns false on 0 0.0 "0" "false" "no" "off" ""
  */

$filterBool = TypeAs::filterBool($mixed, $default);
$nullableFilterBool = TypeAs::nullableFilterBool($mixed, $default);
```

### Custom Resolvers

[SIGNATURES#resolver-registration](docs/signatures.md#resolver-registration)

Each base type has an associated interface located in `Smpita\TypeAs\Contracts` which you can implement to make your own resolvers.

Simply implement the interface, then either register the resolver or use it in the resolver method.

### Interfaces

All resolvers extend the same interfaces. Non-nullable methods throw when `null` is returned by a resolver.

- `Smpita\TypeAs\Contracts\ArrayResolver`
- `Smpita\TypeAs\Contracts\BoolResolver`
- `Smpita\TypeAs\Contracts\ClassResolver`
- `Smpita\TypeAs\Contracts\FloatResolver`
- `Smpita\TypeAs\Contracts\IntResolver`
- `Smpita\TypeAs\Contracts\StringResolver`

### Creating Custom Resolvers

```php
use Smpita\TypeAs\Contracts\StringResolver;

class CustomStringResolver implements StringResolver
{
    /**
     * @throws \Smpita\TypeAs\Exceptions\TypeAsResolutionException
     */
    public function resolve(mixed $value, string $default = null): string
    {
        /**
         * Your logic here
         *
         * Note:
         * The resolver is responsible for returning $default when appropriate.
         * See \Smpita\TypeAs\Resolvers for examples.
         */
    }
}
```

### Registering Custom Resolvers

#### Globally

To globally register a resolver, use the associated setter method. In Laravel, it's recommended to do this in the boot method of a `ServiceProvider`.

```php
use Smpita\TypeAs\TypeAs;

TypeAs::setArrayResolver(new CustomArrayResolver());
TypeAs::setBoolResolver(new CustomBoolResolver());
TypeAs::setClassResolver(new CustomClassResolver());
TypeAs::setFloatResolver(new CustomFloatResolver());
TypeAs::setIntResolver(new CustomIntResolver());
TypeAs::setStringResolver(new CustomStringResolver());
```

### Unregistering Custom Resolvers

To return to default, set the resolver to `null`.

```php
use Smpita\TypeAs\TypeAs;

TypeAs::setArrayResolver(null);
TypeAs::setBoolResolver(null);
TypeAs::setClassResolver(null);
TypeAs::setFloatResolver(null);
TypeAs::setIntResolver(null);
TypeAs::setStringResolver(null);

// Return all resolvers to default
TypeAs::useDefaultResolvers();
```

#### Single use

Inject a resolver to use it on a per call basis.

```php
use Smpita\TypeAs\TypeAs;

// Non-nullable methods
$array = TypeAs::array($mixed, resolver: new CustomArrayResolver());
$bool = TypeAs::bool($mixed, resolver: new CustomBoolResolver());
$class = TypeAs::class(Expected::class, $mixed, resolver: new CustomClassResolver());
$float = TypeAs::float($mixed, resolver: new CustomFloatResolver());
$int = TypeAs::int($mixed, resolver: new CustomIntResolver());
$string = TypeAs::string($mixed, resolver: new CustomStringResolver());

// Nullable methods use same resolver interface
$nullableArray = TypeAs::nullableArray($mixed, resolver: new CustomArrayResolver());
$nullableBool = TypeAs::nullableBool($mixed, resolver: new CustomBoolResolver());
$nullableClass = TypeAs::nullableClass(Expected::class, $mixed, resolver: new CustomClassResolver());
$nullableFloat = TypeAs::nullableFloat($mixed, resolver: new CustomFloatResolver());
$nullableInt = TypeAs::nullableInt($mixed, resolver: new CustomIntResolver());
$nullableString = TypeAs::nullableString($mixed, resolver: new CustomStringResolver());

// Or with positional params
$array = TypeAs::array($mixed, null, new CustomArrayResolver());
$string = TypeAs::string($mixed, null, new CustomStringResolver());
$nullableArray = TypeAs::nullableArray($mixed, null, new CustomArrayResolver());
$nullableString = TypeAs::nullableString($mixed, null, new CustomStringResolver());
```

If you registered a custom resolver then want to use a default resolver on a per call basis, pass the default resolver class.

```php
use Smpita\TypeAs\TypeAs;

$array = TypeAs::array($mixed, resolver: new \Smpita\TypeAs\Resolvers\AsArray());
$bool = TypeAs::bool($mixed, resolver: new \Smpita\TypeAs\Resolvers\AsBool());
$class = TypeAs::class(Expected::class, $mixed, resolver: \Smpita\TypeAs\Resolvers\AsClass());
$float = TypeAs::float($mixed, resolver: new \Smpita\TypeAs\Resolvers\AsFloat());
$int = TypeAs::int($mixed, resolver: new \Smpita\TypeAs\Resolvers\AsInt());
$string = TypeAs::string($mixed, resolver: new \Smpita\TypeAs\Resolvers\AsString());

// Nullable methods use same resolver classes
$nullableArray = TypeAs::nullableArray($mixed, resolver: new \Smpita\TypeAs\Resolvers\AsArray());
$nullableBool = TypeAs::nullableBool($mixed, resolver: new \Smpita\TypeAs\Resolvers\AsBool());
$nullableClass = TypeAs::nullableClass(Expected::class, $mixed, resolver: new \Smpita\TypeAs\Resolvers\AsClass());
$nullableFloat = TypeAs::nullableFloat($mixed, resolver: new \Smpita\TypeAs\Resolvers\AsFloat());
$nullableInt = TypeAs::nullableInt($mixed, resolver: new \Smpita\TypeAs\Resolvers\AsInt());
$nullableString = TypeAs::nullableString($mixed, resolver: new \Smpita\TypeAs\Resolvers\AsString());
```

---

## Helpers

[SIGNATURES#helpers](docs/signatures.md#helpers)

### Global

```php
// Standard Helpers
$array = asArray($mixed);
$bool = asBool($mixed);
$filterBool = asFilterBool($mixed);
$class = asClass(Target::class, $mixed);
$float = asFloat($mixed);
$int = asInt($mixed);
$string = asString($mixed);
$nullableArray = asNullableArray($mixed);
$nullableBool = asNullableBool($mixed);
$nullableFilterBool = asNullableFilterBool($mixed);
$nullableClass = asNullableClass(Target::class, $mixed);
$nullableFloat = asNullableFloat($mixed);
$nullableInt = asNullableInt($mixed);
$nullableString = asNullableString($mixed);

// Fluent Helpers
$type = type($mixed);
```

### Local

Each global helper has a local counterpart you can import if the global helper collides with another global method.

```php
use function Smpita\TypeAs\asArray as TypeAsArray;
use function Smpita\TypeAs\asBool as TypeAsBool;
use function Smpita\TypeAs\asFilterBool as TypeAsFilterBool;
use function Smpita\TypeAs\asClass as TypeAsClass;
use function Smpita\TypeAs\asFloat as TypeAsFloat
use function Smpita\TypeAs\asInt as TypeAsInt;
use function Smpita\TypeAs\asString as TypeAsString;
use function Smpita\TypeAs\asNullableArray as TypeAsNullableArray;
use function Smpita\TypeAs\asNullableBool as TypeAsNullableBool;
use function Smpita\TypeAs\asNullableFilterBool as TypeAsNullableFilterBool;
use function Smpita\TypeAs\asNullableClass as TypeAsNullableClass;
use function Smpita\TypeAs\asNullableFloat as TypeAsNullableFloat;
use function Smpita\TypeAs\asNullableInt as TypeAsNullableInt;
use function Smpita\TypeAs\asNullableString as TypeAsNullableString;
use function Smpita\TypeAs\type as TypeAsType;
```
---

## Deprecations

Please see the [Upgrade Guide](docs/upgrading.md) and [SIGNATURES#deprecations](docs/signatures.md#deprecations) if you encounter a breaking change.

---

## Testing

```bash
composer test
```

---

## Changelog

Please see [RELEASES](https://github.com/smpita/typeas/releases) for more information on what has changed recently.

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
