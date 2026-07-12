## Upgrading
When a breaking change must occur, it will be documented here as well as what to do about it.

Reference: [Deprecations](signatures.md#deprecations)

## v5.0.0

### All nullable resolver interfaces removed
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
- `setNullableStringResolver()` -> ` setStringResolver()`

### Resolver method signature changes
Return type-hint changed on resolver parameters:

```php
// Replace (nullable)
public function resolve(mixed $value, ?bool $default = null): bool;

// With (non-nullable)
public function resolve(mixed $value, ?bool $default = null): ?bool;
```

### Removed Abstracts/Resolver.php base class
- The deprecated `Abstracts/Resolver.php` base class is removed.
- Throwing Exceptions has been removed as a resolvers concern.
- Custom resolvers may return `null` to interact with exception handler, but must implement a `Smpita\TypeAs\Contracts` interface.

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
