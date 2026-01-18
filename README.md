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
  - [Official Extensions](#official-extensions)
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

### Fluent Syntax

TypeAs supports fluent syntax.

#### Basic Usage

```php
use Smpita\TypeAs\TypeAs;

$array = TypeAs::from($mixed)->toArray();
$bool = TypeAs::from($mixed)->toBool();
$filterBool = TypeAs::from($mixed)->toFilterBool()
$class = TypeAs::from($mixed)->toClass(Expected::class);
$float = TypeAs::from($mixed)->toFloat();
$int = TypeAs::from($mixed)->toInt();
$string = TypeAs::from($mixed)->toString();
```

#### Nullable

Chain `nullable()` for nullable returns.

Note: Moving between NonNullable and Nullable returns a new instance of a different class.

```php
use Smpita\TypeAs\TypeAs;

$nullableArray = TypeAs::from($mixed)
    ->nullable()
    ->toArray();
```

```php
use Smpita\TypeAs\TypeAs;

$array = $typeAsNullableInstance
    ->nonNullable()
    ->toArray();
```

#### Custom Resolver

Chain `using()` to resolve using a [Custom Resolver](#custom-resolvers).

```php
use Smpita\TypeAs\TypeAs;

$array = TypeAs::from($mixed)
    ->using(new CustomArrayResolver())
    ->toArray();
```

#### Defaults

Chain `default()` to specify a default.

```php
use Smpita\TypeAs\TypeAs;

$array = TypeAs::from($mixed)
    ->default([])
    ->toArray();
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
TypeAs::array('', wrap: false);
TypeAs::array('', null, null, false);
TypeAs::from('')->noWrap()->toArray();
TypeAs::from('')->wrap(false)->toArray();
```

# Copying

```php
use Smpita\TypeAs\TypeAs;

$instance = TypeAs::->from($mixed);

$assignment = $instance; // $assignment mutates when $instance changes.
$copy = $instance->copy(); // $copy is unaffected by changes to $instance.
$clone = clone $instance; // $clone is unaffected by changes to $instance.
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

-   `Smpita\TypeAs\Contracts\ArrayResolver`
-   `Smpita\TypeAs\Contracts\BoolResolver`
-   `Smpita\TypeAs\Contracts\ClassResolver`
-   `Smpita\TypeAs\Contracts\FloatResolver`
-   `Smpita\TypeAs\Contracts\IntResolver`
-   `Smpita\TypeAs\Contracts\StringResolver`
-   `Smpita\TypeAs\Contracts\NullableArrayResolver`
-   `Smpita\TypeAs\Contracts\NullableClassResolver`
-   `Smpita\TypeAs\Contracts\NullableFloatResolver`
-   `Smpita\TypeAs\Contracts\NullableIntResolver`
-   `Smpita\TypeAs\Contracts\NullableStringResolver`

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
TypeAs::setNullableArrayResolver(new CustomNullableArrayResolver());
TypeAs::setNullableBoolResolver(new CustomNullableBoolResolver());
TypeAs::setNullableClassResolver(new CustomNullableClassResolver());
TypeAs::setNullableFloatResolver(new CustomNullableFloatResolver());
TypeAs::setNullableIntResolver(new CustomIntNullableResolver());
TypeAs::setNullableStringResolver(new CustomNullableStringResolver());
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
TypeAs::setNullableArrayResolver(null);
TypeAs::setNullableBoolResolver(null);
TypeAs::setNullableClassResolver(null);
TypeAs::setNullableFloatResolver(null);
TypeAs::setNullableIntResolver(null);
TypeAs::setNullableStringResolver(null);

// Return all resolvers to default
TypeAs::useDefaultResolvers();
```

#### Single use

Inject a resolver to use it on a per call basis.
```php
use Smpita\TypeAs\TypeAs;

$array = TypeAs::array($mixed, resolver: new CustomArrayResolver());
$bool = TypeAs::bool($mixed, resolver: new CustomBoolResolver());
$class = TypeAs::class(Expected::class, $mixed, resolver: new CustomClassResolver());
$float = TypeAs::float($mixed, resolver: new CustomFloatResolver());
$int = TypeAs::int($mixed, resolver: new CustomIntResolver());
$string = TypeAs::string($mixed, resolver: new CustomStringResolver());
$nullableArray = TypeAs::nullableArray($mixed, resolver: new CustomNullableArrayResolver());
$nullableBool = TypeAs::nullableBool($mixed, resolver: new CustomNullableBoolResolver());
$nullableClass = TypeAs::nullableClass(Expected::class, $mixed, resolver: new CustomNullableClassResolver());
$nullableFloat = TypeAs::nullableFloat($mixed, resolver: new CustomNullableFloatResolver());
$nullableInt = TypeAs::nullableInt($mixed, resolver: new CustomNullableIntResolver());
$nullableString = TypeAs::nullableString($mixed, resolver: new CustomNullableStringResolver());

// or

$array = TypeAs::array($mixed, null, new CustomArrayResolver());
$bool = TypeAs::bool($mixed, null, new CustomBoolResolver());
$class = TypeAs::class(Expected::class, $mixed, null, new CustomClassResolver());
$float = TypeAs::float($mixed, null, new CustomFloatResolver());
$int = TypeAs::int($mixed, null, new CustomIntResolver());
$string = TypeAs::string($mixed, null, new CustomStringResolver());
$nullableArray = TypeAs::nullableArray($mixed, null, new CustomNullableArrayResolver());
$nullableBool = TypeAs::nullableBool($mixed, null, new CustomNullableBoolResolver());
$nullableClass = TypeAs::nullableClass(Expected::class, $mixed, null, new CustomNullableClassResolver());
$nullableFloat = TypeAs::nullableFloat($mixed, null, new CustomNullableFloatResolver());
$nullableInt = TypeAs::nullableInt($mixed, null, new CustomNullableIntResolver());
$nullableStTypeAs::nullableString($mixed, null, new CustomNullableStringResolver());
```

If you registered a custom resolver then want to use a default resolver on a per call basis, you must pass a default resolver.

```php
use Smpita\TypeAs\TypeAs;

$array = TypeAs::array($mixed, resolver: new \Smpita\TypeAs\Resolvers\AsArray());
$bool = TypeAs::bool($mixed, resolver: new \Smpita\TypeAs\Resolvers\AsBool());
$class = TypeAs::class(Expected::class, $mixed, resolver: \Smpita\TypeAs\Resolvers\AsClass());
$float = TypeAs::float($mixed, resolver: new \Smpita\TypeAs\Resolvers\AsFloat());
$int = TypeAs::int($mixed, resolver: new \Smpita\TypeAs\Resolvers\AsInt());
$string = TypeAs::string($mixed, resolver: new \Smpita\TypeAs\Resolvers\AsString());
$nullableArray = TypeAs::nullableArray($mixed, resolver: new \Smpita\TypeAs\Resolvers\AsNullableArray());
$nullableBool = TypeAs::nullableBool($mixed, resolver: new \Smpita\TypeAs\Resolvers\AsNullableBool());
$nullableClass = TypeAs::nullableClass(Expected::class, $mixed, resolver: new \Smpita\TypeAs\Resolvers\AsNullableClass());
$nullableFloat = TypeAs::nullableFloat($mixed, resolver: new \Smpita\TypeAs\Resolvers\AsNullableFloat());
$nullableInt = TypeAs::nullableInt($mixed, resolver: new \Smpita\TypeAs\Resolvers\AsNullableInt());
$nullableString = TypeAs::nullableString($mixed, resolver: new \Smpita\TypeAs\Resolvers\AsNullableString());

// or

$array = TypeAs::array($mixed, null, new \Smpita\TypeAs\Resolvers\AsArray());
$bool = TypeAs::bool($mixed, null, new \Smpita\TypeAs\Resolvers\AsBool());
$class = TypeAs::class(Expected::class, $mixed, null, \Smpita\TypeAs\Resolvers\AsClass());
$float = TypeAs::float($mixed, null, new \Smpita\TypeAs\Resolvers\AsFloat());
$int = TypeAs::int($mixed, null, new \Smpita\TypeAs\Resolvers\AsInt());
$string = TypeAs::string($mixed, null, new \Smpita\TypeAs\Resolvers\AsString());
$nullableArray = TypeAs::nullableArray($mixed, null, new \Smpita\TypeAs\Resolvers\AsNullableArray());
$nullableBool = TypeAs::nullableBool($mixed, null, new \Smpita\TypeAs\Resolvers\AsNullableBool());
$nullableClass = TypeAs::nullableClass(Expected::class, $mixed, null, new \Smpita\TypeAs\Resolvers\AsNullableClass());
$nullableFloat = TypeAs::nullableFloat($mixed, null, new \Smpita\TypeAs\Resolvers\AsNullableFloat());
$nullableInt = TypeAs::nullableInt($mixed, null, new \Smpita\TypeAs\Resolvers\AsNullableInt());
$nullableString = TypeAs::nullableString($mixed, null, new \Smpita\TypeAs\Resolvers\AsNullableString());
```

---

## Helpers

[SIGNATURES#helpers](docs/signatures.md#helpers)

```php
use function Smpita\TypeAs\asArray;
use function Smpita\TypeAs\asBool;
use function Smpita\TypeAs\asFilterBool;
use function Smpita\TypeAs\asClass;
use function Smpita\TypeAs\asFloat;
use function Smpita\TypeAs\asInt;
use function Smpita\TypeAs\asString;
use function Smpita\TypeAs\asNullableArray;
use function Smpita\TypeAs\asNullableBool;
use function Smpita\TypeAs\asNullableFilterBool;
use function Smpita\TypeAs\asNullableClass;
use function Smpita\TypeAs\asNullableFloat;
use function Smpita\TypeAs\asNullableInt;
use function Smpita\TypeAs\asNullableString;

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
```

---

## Deprecations

Please see [SIGNATURES#deprecations](docs/signatures.md#deprecations) if you encounter a breaking change.

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
