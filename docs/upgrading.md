## Upgrading
When a breaking change must occur, it will be documented here as well as what to do about it.

Reference: [Deprecations](signatures.md#deprecations)

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
