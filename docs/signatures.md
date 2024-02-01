## Methods and Signatures

### Resolving

#### Array

```php
Smpita\TypeAs::array(mixed $value, bool|array $wrap = true, ?ArrayResolver $resolver = null): array
```

```php
Smpita\TypeAs::nullableArray(mixed $value, bool|array $wrap = true, ?NullableArrayResolver $resolver = null): ?array
```

#### Class

```php
Smpita\TypeAs::class(string $class, mixed $value, object $default = null, ?ClassResolver $resolver = null): object
```

```php
Smpita\TypeAs::nullableClass(string $class, mixed $value, object $default = null, ?NullableClassResolver $resolver = null): ?object
```

#### Float

```php
Smpita\TypeAs::float(mixed $value, float $default = null, >FloatResolver $resolver = null): float
```

```php
Smpita\TypeAs::nullableFloat(mixed $value, float $default = null, ?NullableFloatResolver $resolver = null): ?float
```

#### Integer

```php
Smpita\TypeAs::int(mixed $value, int $default = null, ?IntResolver $resolver = null): int
```

```php
Smpita\TypeAs::nullableInt(mixed $value, int $default = null, ?NullableIntResolver $resolver = null): ?int
```

#### String

```php
Smpita\TypeAs::string(mixed $value, string $default = null, ?StringResolver $resolver = null): string
```

```php
Smpita\TypeAs::nullableString(mixed $value, string $default = null, ?NullableStringResolver $resolver = null): ?string
```

### Resolver registration

```php
Smpita\TypeAs::useDefaultResolvers(): void
```

```php
Smpita\TypeAs::setArrayResolver(?\Smpita\TypeAs\Contracts\ArrayResolver $resolver): void
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

### Helpers

```php
\Smpita\TypeAs\asArray(mixed $value, bool|array $wrap = true, ?ArrayResolver $resolver = null): array
```

```php
\Smpita\TypeAs\asClass(string $class, mixed $value, object $default = null, ?ClassResolver $resolver = null)
```

```php
\Smpita\TypeAs\asFloat(mixed $value, float $default = null, ?FloatResolver $resolver = null): float
```

```php
\Smpita\TypeAs\asInt(mixed $value, int $default = null, ?IntResolver $resolver = null): int
```

```php
\Smpita\TypeAs\asNullableArray(mixed $value, bool|array $wrap = true, ?NullableArrayResolver $resolver = null): ?array
```

```php
\Smpita\TypeAs\asNullableClass(string $class, mixed $value, object $default = null, ?NullableClassResolver $resolver = null): ?object
```

```php
\Smpita\TypeAs\asNullableFloat(mixed $value, float $default = null, ?NullableFloatResolver $resolver = null): ?float
```

```php
\Smpita\TypeAs\asNullableInt(mixed $value, int $default = null, ?NullableIntResolver $resolver = null): ?int
```

```php
\Smpita\TypeAs\asNullableString(mixed $value, string $default = null, ?NullableStringResolver $resolver = null): ?string
```

```php
\Smpita\TypeAs\asString(mixed $value, string $default = null, ?StringResolver $resolver = null): string
```

---

## Deprecations

#### Carbon

```php
// (DEPRECATED in v2.5.0, REMOVED in v3.0.0)
Smpita\TypeAs::carbon(mixed $value, DateTimeZone|string|null $tz = null, Carbon $default = null, CarbonResolver $resolver = null): Carbon
```

```php
// (DEPRECATED in v2.5.0, REMOVED in v3.0.0)
Smpita\TypeAs::nullableCarbon(mixed $value, DateTimeZone|string|null $tz = null, Carbon $default = null, NullableCarbonResolver $resolver = null): ?Carbon
```

```php
// (DEPRECATED in v2.5.0, REMOVED in v3.0.0)
Smpita\TypeAs::setCarbonResolver(?\Smpita\TypeAs\Contracts\CarbonResolver $resolver): void
```

```php
// (DEPRECATED in v2.5.0, REMOVED in v3.0.0)
Smpita\TypeAs::setNullableCarbonResolver(?\Smpita\TypeAs\Contracts\NullableCarbonResolver $resolver): void
```

#### Class

```php
// (DEPRECATED in v1.0.1, UPDATED in v2.0.0)
\Smpita\TypeAs\asClass(mixed $value, string $class, object $default = null): object
```

```php
// (DEPRECATED in v1.0.1, UPDATED in v2.0.0)
\Smpita\TypeAs\asNullableClass(mixed $value, string $class, object $default = null): ?object
```
