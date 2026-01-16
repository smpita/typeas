## Methods and Signatures

### Resolving

#### Array

```php
Smpita\TypeAs::array(mixed $value, ?array $default = null, ?ArrayResolver $resolver = null, ?bool $wrap = true): array

Smpita\TypeAs::nullableArray(mixed $value, ?array $default = null, ?NullableArrayResolver $resolver = null, ?bool $wrap = true): ?array
```

#### Boolean

```php
Smpita\TypeAs::bool(mixed $value, ?bool $default = null, ?BoolResolver $resolver = null): bool

Smpita\TypeAs::nullableBool(mixed $value, ?bool $default = null, ?NullableBoolResolver $resolver = null): ?bool
```

#### Class

```php
Smpita\TypeAs::class(string $class, mixed $value, ?object $default = null, ?ClassResolver $resolver = null): object

Smpita\TypeAs::nullableClass(string $class, mixed $value, ?object $default = null, ?NullableClassResolver $resolver = null): ?object
```

#### Float

```php
Smpita\TypeAs::float(mixed $value, ?float $default = null, >FloatResolver $resolver = null): float

Smpita\TypeAs::nullableFloat(mixed $value, ?float $default = null, ?NullableFloatResolver $resolver = null): ?float
```

#### Integer

```php
Smpita\TypeAs::int(mixed $value, ?int $default = null, ?IntResolver $resolver = null): int

Smpita\TypeAs::nullableInt(mixed $value, ?int $default = null, ?NullableIntResolver $resolver = null): ?int
```

#### String

```php
Smpita\TypeAs::string(mixed $value, ?string $default = null, ?StringResolver $resolver = null): string

Smpita\TypeAs::nullableString(mixed $value, ?string $default = null, ?NullableStringResolver $resolver = null): ?string
```

### Resolver registration

#### Global

```php
Smpita\TypeAs::useDefaultResolvers(): void
```

#### Array

```php
Smpita\TypeAs::setArrayResolver(?\Smpita\TypeAs\Contracts\ArrayResolver $resolver): void

Smpita\TypeAs::setNullableArrayResolver(?\Smpita\TypeAs\Contracts\NullableArrayResolver $resolver): void
```

#### Bool

```php
Smpita\TypeAs::setBoolResolver(?\Smpita\TypeAs\Contracts\BoolResolver $resolver): void

Smpita\TypeAs::setNullableBoolResolver(?\Smpita\TypeAs\Contracts\NullableBoolResolver $resolver): void
```

#### Class

```php
Smpita\TypeAs::setClassResolver(?\Smpita\TypeAs\Contracts\ClassResolver $resolver): void

Smpita\TypeAs::setNullableClassResolver(?\Smpita\TypeAs\Contracts\NullableClassResolver $resolver): void
```

#### Float

```php
Smpita\TypeAs::setFloatResolver(?\Smpita\TypeAs\Contracts\FloatResolver $resolver): void

Smpita\TypeAs::setNullableFloatResolver(?\Smpita\TypeAs\Contracts\NullableFloatResolver $resolver): void
```

#### Int

```php
Smpita\TypeAs::setIntResolver(?\Smpita\TypeAs\Contracts\IntResolver $resolver): void

Smpita\TypeAs::setNullableIntResolver(?\Smpita\TypeAs\Contracts\NullableIntResolver $resolver): void
```

#### String

```php
Smpita\TypeAs::setStringResolver(?\Smpita\TypeAs\Contracts\StringResolver $resolver): void

Smpita\TypeAs::setNullableStringResolver(?\Smpita\TypeAs\Contracts\NullableStringResolver $resolver): void
```

### Helpers

#### Array

```php
\Smpita\TypeAs\asArray(mixed $value, ?array $default = null, ?ArrayResolver $resolver = null, ?bool $wrap = true): array

\Smpita\TypeAs\asNullableArray(mixed $value, ?array $default = null, ?NullableArrayResolver $resolver = null, ?bool $wrap = true): ?array
```

#### Bool

```php
\Smpita\TypeAs\asBool(mixed $value, ?bool $default = null, ?ArrayResolver $resolver = null): bool

\Smpita\TypeAs\asNullableBool(mixed $value, ?bool $default = null, ?NullableBoolResolver $resolver = null): ?bool
```

#### Class

```php
\Smpita\TypeAs\asClass(string $class, mixed $value, ?object $default = null, ?ClassResolver $resolver = null)

\Smpita\TypeAs\asNullableClass(string $class, mixed $value, ?object $default = null, ?NullableClassResolver $resolver = null): ?object
```

#### Float

```php
\Smpita\TypeAs\asFloat(mixed $value, ?float $default = null, ?FloatResolver $resolver = null): float

\Smpita\TypeAs\asNullableFloat(mixed $value, ?float $default = null, ?NullableFloatResolver $resolver = null): ?float
```

#### Int

```php
\Smpita\TypeAs\asInt(mixed $value, ?int $default = null, ?IntResolver $resolver = null): int

\Smpita\TypeAs\asNullableInt(mixed $value, ?int $default = null, ?NullableIntResolver $resolver = null): ?int
```

#### String

```php
\Smpita\TypeAs\asString(mixed $value, string ?$default = null, ?StringResolver $resolver = null): string

\Smpita\TypeAs\asNullableString(mixed $value, ?string $default = null, ?NullableStringResolver $resolver = null): ?string
```

---

## Deprecations

#### Array

```php
// DEPRECATED in v4.0.0, UPDATED in v4.0.0

Smpita\TypeAs::array(mixed $value, bool|array $wrap = true, ?ArrayResolver $resolver = null): array

Smpita\TypeAs::nullableArray(mixed $value, bool|array $wrap = true, ?NullableArrayResolver $resolver = null): ?array
```

#### Carbon

```php
// DEPRECATED in v2.5.0, REMOVED in v3.0.0

Smpita\TypeAs::carbon(mixed $value, DateTimeZone|string|null $tz = null, Carbon $default = null, CarbonResolver $resolver = null): Carbon

Smpita\TypeAs::nullableCarbon(mixed $value, DateTimeZone|string|null $tz = null, Carbon $default = null, NullableCarbonResolver $resolver = null): ?Carbon
```

```php
// DEPRECATED in v2.5.0, REMOVED in v3.0.0

Smpita\TypeAs::setCarbonResolver(?\Smpita\TypeAs\Contracts\CarbonResolver $resolver): void

Smpita\TypeAs::setNullableCarbonResolver(?\Smpita\TypeAs\Contracts\NullableCarbonResolver $resolver): void
```

#### Class

```php
// DEPRECATED in v1.0.1, UPDATED in v2.0.0

\Smpita\TypeAs\asClass(mixed $value, string $class, object $default = null): object

\Smpita\TypeAs\asNullableClass(mixed $value, string $class, object $default = null): ?object
```
