## TypeAs

- Static API: `TypeAs::{method}()` or global helpers. Use to narrow `mixed` type signatures into concrete types.
- Avoid PHP native casts like `(string)`, `(int)`, etc. — they coerce null with no control over the result. Use TypeAs methods instead to choose when to allow null vs throw.
- Non-nullable variants throw `TypeAsResolutionException` on unresolvable input; nullable variants return `null`.

## Architecture

| Non-nullable | Nullable | Factory method signature | Notes |
|---|---|---|---|
| `array` | `nullableArray` | `(mixed $value, ?array $default = null, ?ArrayResolver $resolver = null, ?bool $wrap = true)` | See [Resolving](#resolving) for `$wrap` behavior |
| `bool` | `nullableBool` | `(mixed $value, ?bool $default = null, ?BoolResolver $resolver = null)` | — |
| `filterBool` | `nullableFilterBool` | `(mixed $value, ?bool $default = null)` | Bakes `FILTER_VALIDATE_BOOL` — no resolver param |
| `class` | `nullableClass` | `(string $class, mixed $value, ?object $default = null, ?ClassResolver $resolver = null)` | First arg is class name, pushing default to 3rd position |
| `float` | `nullableFloat` | `(mixed $value, ?float $default = null, ?FloatResolver $resolver = null)` | — |
| `int` | `nullableInt` | `(mixed $value, ?int $default = null, ?IntResolver $resolver = null)` | — |
| `string` | `nullableString` | `(mixed $value, ?string $default = null, ?StringResolver $resolver = null)` | — |

## Object Resolution

- Objects are resolved via `__to{Type}()` then `to{Type}()` methods
- `__toString` is the only one PHP calls automatically (e.g. string interpolation); the rest are library conventions
- **Exception:** `int` uses `__toInteger()`/`toInteger()` (not `__toInt()`/`toInt()`); `class` uses `is_a()` type check instead
- If an object resolves via `__toArray()`/`toArray()` to an array, the resolved array is returned directly (not re-wrapped)

### Resolving

- Non-array values passed to `array()` / `nullableArray()` are auto-wrapped into a single-element array (`[$value]`). Disable with `wrap(false)` or `noWrap()`.
- Wrapping is skipped when the value is already an array.

### Error handling

`TypeAs::onError(...)` / `->onError(...)` — static or fluent

- `message` uses sprintf: first `%s` = type name of the value (e.g. `string`, `integer`, `App\Models\User`), second `%s` = resolver short name (e.g. `AsString`, `AsArray`)
- Default: `"Resolution error converting %s [%s]"`
- Custom exceptions must extend `TypeAsResolutionException`
- Static `TypeAs::onError()` returns a new `TypeFactory` with the settings applied — does not mutate the shared instance
- Fluent `type()->onError(...)` stores settings on the builder, applied when an `as{Type}()` terminal is called

## Helpers

Global `as{Type}()` / `asNullable{Type}()` functions (no import needed). Also available namespaced under `Smpita\TypeAs`:

```php
// Namespaced (requires import)
use function Smpita\TypeAs\{asArray, asBool, asFilterBool, asClass, asFloat, asInt, asString};
use function Smpita\TypeAs\{asNullableArray, asNullableBool, asNullableFilterBool, asNullableClass, asNullableFloat, asNullableInt, asNullableString};
use function Smpita\TypeAs\type;

// Global (available without import)
asArray($value);
asString($value);
```

## Fluent API

### Chainable

Most methods return `$this` for chaining. Exceptions: `copy()` returns a cloned builder; `nonNullable()` / `nullable()` return a new builder of the named variant.

- `type(mixed)` — set the value to resolve
- `default(mixed)`
- `using({Type}Resolver|null)` — resolver must implement the corresponding `Smpita\TypeAs\Contracts\{Type}Resolver` interface
- `wrap(?bool = true)` / `noWrap()` — toggle array wrapping
- `copy()` — returns a cloned builder with current settings
- `onError(?string $message = null, ?string $exception = null)` — see [Error handling](#error-handling); `$exception` is a FQCN string (e.g. `CustomException::class`)
- `nonNullable()` — returns `NonNullable` builder (inherits current chain settings)
- `nullable()` — returns `Nullable` builder (inherits current chain settings)

## Examples

### Basic resolution and wrapping control

```php
// Array wraps non-array values
asArray(''); // ['']

// Wrap-disabled: throws on non-coercible types
type('')->noWrap()->asArray() // throws TypeAsResolutionException with 'Resolution error converting string [AsArray]'

// Nullable returns null for unresolvable types
asNullableFilterBool('a') // null

// Class resolution with fallback
asClass(User::class, null, new User()); // User

// Fluent nullable swap
type([])->nullable()->asString(); // null

// Custom exception with sprintf format
$factory = TypeAs::onError('Cannot resolve %s via %s', CustomException::class);
$factory->filterBool('random'); // CustomException thrown with 'Cannot resolve string via AsFilterBool'

// Custom message (fluent)
type([])->onError('value type: %s [resolver: %s]')->asString(); // throws TypeAsResolutionException with 'value type: array [resolver: AsString]'
```
