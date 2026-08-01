### Guaranteed type control for PHP

- Use \Smpita\TypeAs\TypeAs to narrow types when handling mixed type signatures
- Avoid PHP native casts like (string), (int), etc as they coerce null to values breaking nullable types
- use TypeAs methods to selectively choose when to allow null and when to throw Exceptions

#### Static API

- `array(mixed $value, ?array $default = null, ?ArrayResolver $resolver = null, ?bool $wrap = true)` → array
- `bool(mixed $value, ?bool $default = null, ?BoolResolver $resolver = null)` → bool
- `filterBool(mixed $value, ?bool $default = null)` → bool
- `class(string $class, mixed $value, ?object $default = null, ?ClassResolver $resolver = null)` → object (TClass)
- `float(mixed $value, ?float $default = null, ?FloatResolver $resolver = null)` → float
- `int(mixed $value, ?int $default = null, ?IntResolver $resolver = null)` → int
- `string(mixed $value, ?string $default = null, ?StringResolver $resolver = null)` → string
- `nullableArray(mixed $value, ?array $default = null, ?ArrayResolver $resolver = null, ?bool $wrap = true)` → ?array
- `nullableBool(mixed $value, ?bool $default = null, ?BoolResolver $resolver = null)` → ?bool
- `nullableFilterBool(mixed $value, ?bool $default = null)` → ?bool
- `nullableClass(string $class, mixed $value, ?object $default = null, ?ClassResolver $resolver = null)` → ?object (?TClass)
- `nullableFloat(mixed $value, ?float $default = null, ?FloatResolver $resolver = null)` → ?float
- `nullableInt(mixed $value, ?int $default = null, ?IntResolver $resolver = null)` → ?int
- `nullableString(mixed $value, ?string $default = null, ?StringResolver $resolver = null)` → ?string

#### Fluent API

**Config methods on both NonNullable and Nullable:** `.default(mixed)`, `.using(Resolver|null)`, `.wrap(bool)`, `.noWrap()`, `.onError(?string $message, ?string $exception)`, `.config(): TypeConfig`.

Start with `TypeAs::type($value)` or global helper `type($value)`, then:

- NonNullable: `asArray()`, `asBool()`, `asFilterBool()` → `bool`, `asClass(string $class)` → non-nullable, `asFloat()`, `asInt()`, `asString()`
- Nullable (`->nullable()`): same methods return nullable types (`?array`, `?bool`, `?float`, `?int`, `?string`)

#### Helpers

Available with `use function` imports or globally:

- NonNullable: `use function Smpita\TypeAs\{asArray, asBool, asFilterBool, asClass, asFloat, asInt, asString};`
- Nullable: `use function Smpita\TypeAs\{asNullableArray, asNullableBool, asNullableFilterBool, asNullableClass, asNullableFloat, asNullableInt, asNullableString};`
- Fluent: `use function Smpita\TypeAs\type;`

Gotchas (all APIs):

- NonNullable methods throw TypeAsResolutionException on failure
- Nullable methods return null on failure instead of throwing
- `*array*()`: `wrap` param controls non-iterable coercion (default: true)
- `*class*()`: `class-string $class` param templates return and $default type
- Methods without a `resolver` param are Extensions
- Extension `filterBool()` and its variants use `FILTER_VALIDATE_BOOL`

#### Examples

- Array with wrap control: `TypeAs::array($val, wrap: false)`
- Custom resolver: `TypeAs::array($val, resolver: new CustomArrayResolver())`
- Class resolution (throwing): `TypeAs::class(Expected::class, $val, default: new Expected(), resolver: new ClassResolver())`
- Nullable variant: `TypeAs::nullableClass(Expected::class, $val)`

#### Custom Error API

Configure custom errors via chaining: `TypeAs::onError($message, $exception)->array($val)` returns a cloned TypeFactory with the error config; or fluent `->onError($msg, $class)` on any chain.
