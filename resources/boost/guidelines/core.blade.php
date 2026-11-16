# TypeAs

Global helpers (`as{Type}()`), static `TypeAs::` methods, or fluent builder (`type()`) narrow `mixed` to concrete types. Prefer over PHP casts for null control. Skip when PHP already declares the type.

Helpers live in `src/GlobalHelpers.php`; static API on `Smpita\TypeAs\TypeAs`.

`type($value)` returns NonNullable. `NonNullable::make()` and `Nullable::make()` also available (both accept optional TypeConfig, defaulting to new instance).

Nullable variants: global `asNullable{Type}()` helpers or static `TypeAs::nullable{Type}()`. e.g. `asNullableInt()`, `TypeAs::nullableInt()`.

## Null / Input Rules

*(N) = nullable; (NN) = non-nullable*

- Null input → `$default` (N) or throw (NN). Falsy defaults (`false`, `0`, `""`, `[]`) prevent throw (**??** semantics). Nullable variants return resolved value or `$default` (never throw).
- **Object hooks**: two-gate — `method_exists()` AND `is_callable()`. First non-null result of matching type wins (e.g. AsBool checks `is_bool()`). A hook returning null or wrong type → tries next hook. After all exhausted, falls to `$default`.
- **Early enum check**: bool, filterBool, float, int, string resolve BackedEnums directly (no hooks) — cast `$enum->value` via the type's native path (bool: `boolval()`, filterBool: `filter_var()`, float: `floatval()`, int: `intval()`, string: `strval()`). array defers to hook path. class uses only `is_a()` validation.

## Types

| Type | Helper Sig | Static Sig | Return | BackedEnum Cast | Hooks (object input) | Unhooked Object Cast | Casts from | Behavior |
|---|---|---|---|---|---|---|---|---|
| array | `asArray(mixed $value, ?array $default=null, ?ArrayResolver $resolver=null, ?bool $wrap=true)` | `TypeAs::array(...same params)` | `array / ?array` | `[enum-object]` (wrapped; NN throws with wrap=false) | `__toArray`, `toArray` (first non-null result of matching type wins — incompatible returns fall through) | No matching hook → returns null; if wrap=true wraps value as `[$value]`, else `$default`. | — | Non-array → `[$value]` when wrap=true. Hook returning array used as-is; non-array hook → null then wrapped/default. Wrap disabled: unresolvable → `$default`. NN throws without `$default`. |
| bool | `asBool(mixed $value, ?bool $default=null, ?BoolResolver $resolver=null)` | `TypeAs::bool(...same params)` | `bool / ?bool` | `boolval($enum->value)` | `__toBool`, `toBool` (first non-null result of matching type wins — incompatible returns fall through) | boolval($value) — objects → true | bool, string, int, double, resource, array | **Never throws for non-null inputs.** Incompatible hook return → `boolval($value)` (original object). NN throws only on null input without `$default`. |
| filterBool | `asFilterBool(mixed $value, ?bool $default=null, ?FilterBoolResolver $resolver=null)` | `TypeAs::filterBool(...same params)` | `bool / ?bool` | `filter_var($enum->value, FILTER_VALIDATE_BOOL)` | `__toBool`, `toBool` (first non-null result of matching type wins — incompatible returns fall through) | null → `$default` (NN throws without $default) | bool, string, int, double, resource, array | Strict `FILTER_VALIDATE_BOOL`. Strings: "1"/"true"/"yes"/"on" → true; "0"/"false"/"no"/"off"/"" → false/null. Non-matching strings and incompatible hooks → null → `$default`. Int/float coerced natively. NN throws without `$default`. |
| class | `asClass(string $class, mixed $value, ?object $default=null, ?ClassResolver $resolver=null)` | `TypeAs::class(...same params)` | `TClass / TClass|null / throw` | `is_a($value, $class)` (enum as object) | None (subtype check only) | subtype mismatch → `$default` | — | Match → returns obj. Mismatch → `$default` if given, else throws NN. `asNullableClass` always returns matched/null (never throws). |
| float | `asFloat(mixed $value, ?float $default=null, ?FloatResolver $resolver=null)` | `TypeAs::float(...same params)` | `float / ?float` | `floatval($enum->value)` | `__toFloat`, `toFloat` (first non-null result of matching type wins — incompatible returns fall through) | null → `$default` | bool, string, int, resource, double | Doubles returned unchanged. Objects → resolved via hooks only; unhooked objects → null → `$default`. Non-float hook → null → `$default`. NN throws without `$default`. **Never throws for non-null scalars.** Arrays fall to default. |
| int | `asInt(mixed $value, ?int $default=null, ?IntResolver $resolver=null)` | `TypeAs::int(...same params)` | `int / ?int` | `intval($enum->value)` | `__toInteger`, `__toInt`, `toInteger`, `toInt` (first non-null result of matching type wins — incompatible returns fall through) | null → `$default` | bool, string, double, resource | Bool → 1/0. Truncates decimals (3.9→3). Objects → resolved via hooks only; unhooked objects → null → `$default`. Non-int hook → null → `$default`. NN throws without `$default`. **Never throws for non-null scalars.** Arrays excluded. |
| string | `asString(mixed $value, ?string $default=null, ?StringResolver $resolver=null)` | `TypeAs::string(...same params)` | `string / ?string` | `strval($enum->value)` | `__toString`, `toString` (first non-null result of matching type wins — incompatible returns fall through) | null → `$default` | bool, int, double, resource | Bool → "1"/"". Resources → `"Resource id #N"`. Doubles via strval(). Objects → resolved via hooks only; unhooked objects → null → `$default`. Non-string hook → null → `$default`. NN throws without `$default`. **Never throws for non-null scalars.** Arrays fall to default. |

## Error Handling

`TypeAs::onError(msg, exc)` (static) or `->onError(msg, exc)` (fluent). Custom exceptions must extend `TypeAsResolutionException`.

- **Message format:** `sprintf($message, $runtimeType, $resolverShortName)`.
- **Runtime type:** scalars → `gettype()`: `"string"`, `"integer"`, `"double"` (not "float"), `"boolean"`, `"NULL"`, `"array"`, `"resource"`; objects → `get_class()`.
- **Resolver short name:** basename of resolver class (`App\Resolvers\MyResolver` → `MyResolver`).
- **Default message:** `"Resolution error converting %s [%s]"`.
- **Static `TypeAs::onError()`** returns a new `TypeFactory` (does not mutate shared instance). Validates `$exception` when non-null — invalid class throws `InvalidArgumentException`. Custom exceptions extend `TypeAsResolutionException` (extends `UnexpectedValueException`).
- **Fluent `->onError()`** stores settings on config, applied at terminal call. Null msg/exc reverts defaults. Nullable methods ignore throw settings entirely — `type([])->onError('msg')->nullable()->asString()` never throws (always returns null).

```php
// Static: returns new factory — does not modify shared instance
class MyException extends \Smpita\TypeAs\Exceptions\TypeAsResolutionException {}
TypeAs::onError('Failed: %s [via %s]', MyException::class)->array(null, wrap: false);
// throws MyException with "Failed: NULL [via AsArray]"

// Fluent: stores on TypeConfig — applied at terminal NN call
type([])->onError('value type: %s [%s]')->asString();
// throws TypeAsResolutionException with "value type: array [AsString]"

// asClass mismatch returns $default; NN throws only when $default is null
asClass(Exception::class, new stdClass(), new TypeError()); // returns $default (TypeError)
asNullableClass(Exception::class, new stdClass()); // null — N ignores throw settings

// Runtime types — gettype for scalars, get_class for objects
type(null)->onError('%s [%s]')->asString(); // throws "NULL [AsString]"
```

## Fluent API

### Chainable (return `$this` unless noted)

| Method | Default | Notes |
|---|---|---|
| `type(mixed $value)` | — | Set input value. Also global helper `type($value)`. |
| `default(mixed $default)` | `null` | Stored in TypeConfig::$defaultTo. Fallback on failure/null. |
| `using(Resolver|null)` | — | Concrete resolver → replaces that type's resolver; null → resets that type (lazy-loads on next use). |
| `wrap(?bool)` / `noWrap()` | `true` | Toggle array auto-wrapping. Alias: `noWrap()`. |
| `onError(?string $msg, ?string $exc)` | null/null | Message template + exception FQCN. Null reverts defaults. |
| `copy()` | — | Clones builder and config — resolver references shared (deep clone needed for isolation). |
| `import(TypeConfig)` | — | Replaces builder's config with provided instance (no clone). |
| `nonNullable()` | *(NonNullable)* | Returns NonNullable variant, shares config reference. |
| `nullable()` | *(Nullable)* | Returns Nullable variant, shares config reference. |

### Terminal (return type, not `$this`)

Builder `->default($value)` stores a fallback on config; applied when resolution produces null. Non-nullable variants throw on null without default; nullable variants return null.

**NonNullable** — all return concrete types, throw on failure:

- `asArray(): array` — auto-wraps non-array values
- `asBool(): bool` — **never throws for non-null inputs** (unhooked objects fall to PHP native coercion)
- `asFilterBool(): bool`
- `asFloat(): float`
- `asInt(): int`
- `asString(): string`
- `asClass(string $class): object` — `is_a()` check

**Nullable** — same method names as NonNullable (asArray through asString plus asClass). Each returns nullable variant (`?type`). Resolution always succeeds or returns null (nullable variants never throw):

- `asArray(): ?array` — auto-wraps non-array values
- `asBool(): ?bool` — **never throws** (PHP native coercion on all inputs)
- `asFilterBool(): ?bool`
- `asFloat(): ?float`
- `asInt(): ?int`
- `asString(): ?string`
- `asClass(string $class): TClass|null` — always returns matched object or null

## Resolver Architecture

Default resolver definitions: `src/Config/Definitions/V5.php`. Resolvers loaded from V5 config (e.g. `AsInt::class`, `AsString::class`). `ResolverConfig` is a value object exposing the class-string identifiers for each resolver type — it does not execute any logic.

| Scope | Mechanism |
|---|---|
| Per-type version override | `ResolverVersion::V4->setIntResolver()` etc. — loads each type from that version's config. |
| Switch all resolvers | `ResolverVersion::V4->setResolvers()` or `ResolverVersion::V5->setResolvers()` |
| Per-type override (global) | `TypeAs::set{Type}Resolver(new CustomResolver())` — `{Type}` is Int/Float/String/Class/Array/Bool/FilterBool. Replaces resolver for all future calls of that type. |
| Reset to active defaults | `->using(null)` — clears resolver registry; lazy-loads from active version on first use per type. |
| Global reset | `TypeAs::useDefaultResolvers()` — static method, nulls factory-level resolver repository. |

```php
// Switch versions (separate call required)
ResolverVersion::V4->setResolvers();
ResolverVersion::V5->setResolvers();

// Per-type override on global instance
TypeAs::setIntResolver(new CustomIntResolver());
```

## Examples

```php
// Auto-wraps scalars to [value]
asArray(''); // ['']

// Wrap disabled: non-array input can't resolve → $default or throws
type('')->noWrap()->asArray(); // throws (NN, no default)
asNullableArray('', wrap: false); // null
asNullableArray('', default: [], wrap: false); // [] (explicit default used)

// filterBool strict validation — "a" not matching FILTER_VALIDATE_BOOL patterns
asNullableFilterBool('a'); // null
asNullableFilterBool('a', false); // false (uses provided default)

// asClass: class-name first param; mismatch returns $default (throws NN without it)
asClass(Exception::class, new Exception()); // matches → returns Exception instance
asClass(Exception::class, new stdClass(), new TypeError()); // mismatch → returns TypeError ($default)
asNullableClass(Exception::class, new stdClass()); // null — N ignores throw settings

// Bool never throws for non-null — PHP native coercion always succeeds
asBool(new stdClass()); // true
asBool(0); // false

// Null input: NN throws without $default; N returns result ($default)
type(null)->asString(); // throws TypeAsResolutionException
type(null)->nullable()->asString(); // null

// Fluent swap between variants (shares config reference)
type([])->nullable()->asString(); // null (array unresolvable to string)
type([])->nonNullable()->asString(); // throws (array unresolvable to string)
```
