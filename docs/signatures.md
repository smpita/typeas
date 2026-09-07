## Methods and Signatures

### Resolving

#### Conventions

- Non-nullable methods throw `\Smpita\TypeAs\Exceptions\TypeAsResolutionException` when the value cannot be resolved.
- Nullable methods never throw; they return `null` instead.
- Providing a `default` suppresses throwing: the default is returned when the value cannot be resolved.
- Resolvers signal failure by returning `null`. Non-nullable methods convert that into a throw; nullable methods and defaults pass it through.
- A resolver registered with `setXResolver()` serves both `x()` and `nullableX()` calls.
- Backed enums resolve through their backing value (`$enum->value`), cast to the target type, during resolution.
- Objects may hook resolution by implementing `__toArray`/`toArray`, `__toFloat`/`toFloat`, `__toInteger`/`__toInt`/`toInteger`/`toInt`, `__toString`/`toString`, or `__toBool`/`toBool`. Method calls are gated by `is_callable()`.
- Use `onError(message, exception)` to customize the thrown message or swap in an exception that extends `TypeAsResolutionException`.

#### Resolver Versions

```php
use Smpita\TypeAs\Config\ResolverVersion;

// Returns ResolverVersion::V5
ResolverVersion::default();

// Switch resolver set
ResolverVersion::V4->setResolvers();
ResolverVersion::V5->setResolvers();

// Individual resolver switching
ResolverVersion::V4->setBoolResolver();
ResolverVersion::V5->setFilterBoolResolver();
```

#### ResolverVersion Enum helpers
```
config(): \Smpita\TypeAs\Data\ResolverConfig
setResolvers(): void
setArrayResolver(): void
setBoolResolver(): void
setClassResolver(): void
setFloatResolver(): void
setIntResolver(): void
setStringResolver(): void
```

#### Array

```php
Smpita\TypeAs::array(mixed $value, ?array $default = null, ?ArrayResolver $resolver = null, ?bool $wrap = true): array

Smpita\TypeAs::nullableArray(mixed $value, ?array $default = null, ?ArrayResolver $resolver = null, ?bool $wrap = true): ?array
```

#### Boolean

```php
Smpita\TypeAs::bool(mixed $value, ?bool $default = null, ?BoolResolver $resolver = null): bool

Smpita\TypeAs::nullableBool(mixed $value, ?bool $default = null, ?BoolResolver $resolver = null): ?bool

// Extension using FILTER_VALIDATE_BOOL resolver
Smpita\TypeAs::filterBool(mixed $value, ?bool $default = null): bool

Smpita\TypeAs::nullableFilterBool(mixed $value, ?bool $default = null): ?bool
```

#### Class

```php
Smpita\TypeAs::class(string $class, mixed $value, ?object $default = null, ?ClassResolver $resolver = null): object

Smpita\TypeAs::nullableClass(string $class, mixed $value, ?object $default = null, ?ClassResolver $resolver = null): ?object
```

#### Float

```php
Smpita\TypeAs::float(mixed $value, ?float $default = null, ?FloatResolver $resolver = null): float

Smpita\TypeAs::nullableFloat(mixed $value, ?float $default = null, ?FloatResolver $resolver = null): ?float
```

#### Integer

```php
Smpita\TypeAs::int(mixed $value, ?int $default = null, ?IntResolver $resolver = null): int

Smpita\TypeAs::nullableInt(mixed $value, ?int $default = null, ?IntResolver $resolver = null): ?int
```

#### String

```php
Smpita\TypeAs::string(mixed $value, ?string $default = null, ?StringResolver $resolver = null): string

Smpita\TypeAs::nullableString(mixed $value, ?string $default = null, ?StringResolver $resolver = null): ?string
```

### Custom exceptions

```php
Smpita\TypeAs::onError(?string $message = null, ?string $exception = null): TypeFactory
```

### Resolver registration

#### Global

```php
Smpita\TypeAs::useDefaultResolvers(): void
```

#### Array

```php
Smpita\TypeAs::setArrayResolver(?\Smpita\TypeAs\Contracts\ArrayResolver $resolver): void
```

#### Bool

```php
Smpita\TypeAs::setBoolResolver(?\Smpita\TypeAs\Contracts\BoolResolver $resolver): void
```

#### Class

```php
Smpita\TypeAs::setClassResolver(?\Smpita\TypeAs\Contracts\ClassResolver $resolver): void
```

#### Float

```php
Smpita\TypeAs::setFloatResolver(?\Smpita\TypeAs\Contracts\FloatResolver $resolver): void
```

#### Int

```php
Smpita\TypeAs::setIntResolver(?\Smpita\TypeAs\Contracts\IntResolver $resolver): void
```

#### FilterBool

```php
Smpita\TypeAs::setFilterBoolResolver(?\Smpita\TypeAs\Contracts\BoolResolver $resolver): void
```

#### String

```php
Smpita\TypeAs::setStringResolver(?\Smpita\TypeAs\Contracts\StringResolver $resolver): void
```

### Fluent

#### TypeAs

```php
\Smpita\TypeAs\TypeAs::type($mixed): NonNullable
\Smpita\TypeAs\TypeAs::type($mixed)->onError(?string $message = null, ?string $exception = null): NonNullable;
```

#### `\Smpita\TypeAs\Concerns\Fluent\HandlesFluentCalls`
Trait methods common to NonNullable and Nullable
```php
make(?\Smpita\TypeAs\Fluent\TypeConfig $config = null): self
copy(): self
import(\Smpita\TypeAs\Fluent\TypeConfig $config): self
config(): \Smpita\TypeAs\Fluent\TypeConfig
nonNullable(): \Smpita\TypeAs\Fluent\NonNullable
nullable(): \Smpita\TypeAs\Fluent\Nullable

type(mixed $value): self
default(mixed $default): self
using(null|ArrayResolver|BoolResolver|ClassResolver|FloatResolver|IntResolver|StringResolver $resolver): self
wrap(bool $enabled = true): self
noWrap(): self // Inverse wrapper of wrap()

onError(?string $message = null, ?string $exception = null): self
```

#### `\Smpita\TypeAs\Fluent\NonNullable`

```php
asArray(): array
asBool(): bool
asFilterBool(): bool
asClass(string $class): object
asFloat(): float
asInt(): int
asString(): string
```

#### `\Smpita\TypeAs\Fluent\Nullable`

```php
asArray(): ?array
asBool(): ?bool
asFilterBool(): ?bool
asClass(string $class): ?object
asFloat(): ?float
asInt(): ?int
asString(): ?string
```

### Helpers

#### Array

```php
\Smpita\TypeAs\asArray(mixed $value, ?array $default = null, ?ArrayResolver $resolver = null, ?bool $wrap = true): array

\Smpita\TypeAs\asNullableArray(mixed $value, ?array $default = null, ?ArrayResolver $resolver = null, ?bool $wrap = true): ?array
```

#### Bool

```php
\Smpita\TypeAs\asBool(mixed $value, ?bool $default = null, ?BoolResolver $resolver = null): bool

\Smpita\TypeAs\asNullableBool(mixed $value, ?bool $default = null, ?BoolResolver $resolver = null): ?bool

\Smpita\TypeAs\asFilterBool(mixed $value, ?bool $default = null): bool

\Smpita\TypeAs\asNullableFilterBool(mixed $value, ?bool $default = null): ?bool
```

#### Class

```php
\Smpita\TypeAs\asClass(string $class, mixed $value, ?object $default = null, ?ClassResolver $resolver = null)

\Smpita\TypeAs\asNullableClass(string $class, mixed $value, ?object $default = null, ?ClassResolver $resolver = null): ?object
```

#### Float

```php
\Smpita\TypeAs\asFloat(mixed $value, ?float $default = null, ?FloatResolver $resolver = null): float

\Smpita\TypeAs\asNullableFloat(mixed $value, ?float $default = null, ?FloatResolver $resolver = null): ?float
```

#### Int

```php
\Smpita\TypeAs\asInt(mixed $value, ?int $default = null, ?IntResolver $resolver = null): int

\Smpita\TypeAs\asNullableInt(mixed $value, ?int $default = null, ?IntResolver $resolver = null): ?int
```

#### String

```php
\Smpita\TypeAs\asString(mixed $value, ?string $default = null, ?StringResolver $resolver = null): string

\Smpita\TypeAs\asNullableString(mixed $value, ?string $default = null, ?StringResolver $resolver = null): ?string
```

---

## Deprecations

See [Resolving](#Resolving) for current signatures.

See the [Upgrade Guide](upgrading.md#Upgrading) for tips on how to handle deprecations.

#### All / Multiple types

```php
// DEPRECATED in v5.0.0, UPDATED in v5.0.0
// Promoted nullable resolvers to primary resolvers

Smpita\TypeAs::nullableArray(mixed $value, ?array $default = null, ?ArrayResolver $resolver = null, ?bool $wrap = true): ?array

Smpita\TypeAs::nullableBool(mixed $value, ?bool $default = null, ?BoolResolver $resolver = null): ?bool

Smpita\TypeAs::nullableClass(string $class, mixed $value, ?object $default = null, ?ClassResolver $resolver = null)//: ?object

Smpita\TypeAs::nullableFloat(mixed $value, ?float $default = null, ?FloatResolver $resolver = null): ?float

Smpita\TypeAs::nullableInt(mixed $value, ?int $default = null, ?IntResolver $resolver = null): ?int

Smpita\TypeAs::nullableString(mixed $value, ?string $default = null, ?StringResolver $resolver = null): ?string
```

#### Array

```php
// DEPRECATED in v4.0.0, UPDATED in v4.0.0
// Swapped order of $wrap and $resolver parameters

Smpita\TypeAs::array(mixed $value, ?array $default = null, bool|array $wrap = true, ?ArrayResolver $resolver = null): array

Smpita\TypeAs::nullableArray(mixed $value, ?array $default = null, bool|array $wrap = true, ?NullableArrayResolver $resolver = null): ?array
```

#### Carbon

```php
// DEPRECATED in v2.5.0, REMOVED in v3.0.0
// Removed Carbon feature

Smpita\TypeAs::carbon(mixed $value, DateTimeZone|string|null $tz = null, Carbon $default = null, CarbonResolver $resolver = null): Carbon

Smpita\TypeAs::nullableCarbon(mixed $value, DateTimeZone|string|null $tz = null, Carbon $default = null, NullableCarbonResolver $resolver = null): ?

Smpita\TypeAs::setCarbonResolver(?\Smpita\TypeAs\Contracts\CarbonResolver $resolver): void

Smpita\TypeAs::setNullableCarbonResolver(?\Smpita\TypeAs\Contracts\NullableCarbonResolver $resolver): void
```

#### Class

```php
// DEPRECATED in v1.0.1, UPDATED in v2.0.0
// Swapped order of $value and $class parameters

\Smpita\TypeAs\asClass(mixed $value, string $class, object $default = null): object

\Smpita\TypeAs\asNullableClass(mixed $value, string $class, object $default = null): ?object
```
