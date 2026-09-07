## Upgrading
When a breaking change must occur, it will be documented here as well as what to do about it.

Reference: [Deprecations](signatures.md#deprecations)

## v5.0.0

### All nullable resolver interfaces removed

Registered resolvers now apply to both the non-nullable and nullable methods. There are no separate nullable resolvers.

```php
// Replace
class CustomResolver implements NullableBoolResolver {}

// With
class CustomResolver implements BoolResolver {}
```

Update method calls:
- `setNullableArrayResolver()` -> `setArrayResolver()`
- `setNullableBoolResolver()` -> `setBoolResolver()`
- `setNullableClassResolver()` -> `setClassResolver()`
- `setNullableFloatResolver()` -> `setFloatResolver()`
- `setNullableIntResolver()` -> `setIntResolver()`
- `setNullableStringResolver()` -> `setStringResolver()`

### Resolvers

See [Resolver Versions](signatures.md#resolver-versions) for resolver version switching reference.

The resolvers received the following updates:
- Scalar methods cast Enum values (e.g. `asFilterBool(Enum::Off) // false assuming backed value is 'off'`)
- More consistent hunting for `__to{Type}` and `to{Type}`
    - Method calling is now gated by `is_callable()` to ensure only public methods are called

Resolver versions manage which set of resolvers TypeAs uses. TypeAs defaults to V5; switching to V4 restores legacy behavior via `src/Resolvers/Legacy/V4`.

Switch the active version:

```php
use Smpita\TypeAs\Config\ResolverVersion;

// Set V4 (legacy) resolvers globally
ResolverVersion::V4->setResolvers();

// Revert to V5 (default) resolvers
ResolverVersion::V5->setResolvers();
```

Each version has its own definition class (`V4` or `V5`) that controls which resolver classes are used. Each resolver can also be set individually:

```php
use Smpita\TypeAs\Config\ResolverVersion;

// Set just the bool resolver to a V4 variant
ResolverVersion::V4->setBoolResolver();
```

To restore all resolvers to their default state (unregistered/null), call:

```php
TypeAs::useDefaultResolvers();
```

Note: `useDefaultResolvers()` sets each resolver registry to `null` allowing resolvers to lazy register from defaults.
Use `ResolverVersion::V4->setResolvers()` if you want to stay on the legacy resolvers.

### Resolver method signature changes
All resolver `resolve()` return types are now nullable.

```php
// Replace
public function resolve(mixed $value, ?array $default = null, ?bool $wrap = true): array;
public function resolve(mixed $value, ?bool $default = null): bool;
public function resolve(string $class, mixed $value, ?object $default = null); // @return TClass
public function resolve(mixed $value, ?float $default = null): float;
public function resolve(mixed $value, ?int $default = null): int;
public function resolve(mixed $value, ?string $default = null): string;

// With
public function resolve(mixed $value, ?array $default = null, ?bool $wrap = true): ?array;
public function resolve(mixed $value, ?bool $default = null): ?bool;
public function resolve(string $class, mixed $value, ?object $default = null); // @return TClass|null
public function resolve(mixed $value, ?float $default = null): ?float;
public function resolve(mixed $value, ?int $default = null): ?int;
public function resolve(mixed $value, ?string $default = null): ?string;
```

Note: `ClassResolver::resolve()` has no native return type; the change is in its docblock.

### Removed Abstracts/Resolver.php base class
- The deprecated `Abstracts/Resolver.php` base class is removed.
- Throwing Exceptions has been removed as a resolvers concern.
- Custom resolvers may return `null` to interact with exception handler, but must implement a `Smpita\TypeAs\Contracts` interface.

### New conversion behavior
- Backed enums resolve through their backing value (`$enum->value`), cast to the target type, during `int` and `string` resolution.
- Objects implementing `__toBool()` or `toBool()` resolve through those methods during `bool` resolution.
- Object magic-method detection now uses `is_callable()` instead of `method_exists()`, so `__call()`-based implementations of `__toArray`/`toArray`, `__toFloat`/`toFloat`, `__toInteger`/`__toInt`/`toInteger`/`toInt`, `__toString`/`toString`, and `__toBool`/`toBool` are honored.

### Custom error handling
Use the new `onError()` to customize the thrown message or exception. See [Custom Exceptions](../README.md#custom-exceptions). Exceptions must extend `TypeAsResolutionException`.

---

## v4.0.0

If you disable array wrapping by using positional parameters, you will encounter a breaking change.
```php
// Replace
TypeAs::array($mixed, $wrap);
TypeAs::nullableArray($mixed, $wrap);

// With
TypeAs::array($mixed, wrap: $wrap);
TypeAs::nullableArray($mixed, wrap: $wrap);
```

---

## v3.0.0

If you use the Carbon methods, you will encounter a breaking change.
```php
// Replace
TypeAs::carbon($mixed, $tz);
TypeAs::nullableCarbon($mixed, $tz);

// With
$carbon = \Carbon\Carbon::parse($mixed, $tx);
TypeAs::class(\Carbon\Carbon::class, $carbon);
TypeAs::nullableClass(\Carbon\Carbon::class, $carbon);
```

These methods have no equivalent and must be removed.
You may still use the resolvers to build your carbon instance and pass it to the class method.
```php
// Replace
TypeAs::setCarbonResolver($resolver);
TypeAs::setNullableCarbonResolver($resolver);

// with this but at the previous TypeAs::carbon() calls.
$carbon = $resolver->resolve($mixed, $tx);
TypeAs::class(\Carbon\Carbon::class, $carbon);
TypeAs::nullableClass(\Carbon\Carbon::class, $carbon);
```

---

## v2.0.0
If you use the class methods, you will encounter a breaking change.
```php
// Replace
TypeAs::asClass($mixed, $class);
TypeAs::asNullableClass($mixed, $class);

// With
TypeAs::class($class, $mixed);
TypeAs::nullableClass($class, $mixed);
```
