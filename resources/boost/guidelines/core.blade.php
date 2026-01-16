### Guaranteed type control for PHP

- Use \Smpita\TypeAs\TypeAs to narrow types when handling mixed type signatures.
- Avoid casts like (string) and (int). Use TypeAs::string() and TypeAs::int() and similar methods instead.
- Use nullable methods like TypeAs::nullableArray() and TypeAs::nullableFloat() when a null is a feasible value.
- Use TypeAs::filterBool() to apply FILTER_VALIDATE_BOOL rules instead of filter_var().
- TypeAs::array() will wrap non-iterable values in an array. Use the wrap parameter to control this behavior, e.g. TypeAs::array($mixed, wrap: false).
- Default values can be provided as the second parameter, or the third parameter for class, e.g. TypeAs::array($mixed, default: []) and TypeAs::class(Expected::class, $mixed, default: new Expected()).
- Helpers like asArray(), asNullableArray(), asBool(), etc are available for all types but they need to be imported, e.g. use function Smpita\TypeAs\asArray;
- A custom resolver that implements the appropriate Smpita\TypeAs\Contracts interface can be provided as the third parameter, e.g. TypeAs::array($mixed, resolver: new ArrayResolver()).

@verbatim
<code-snippet name="How to type as array" lang="php">
$array = TypeAs::array($mixed);
</code-snippet>
@endverbatim

@verbatim
<code-snippet name="How to type as nullable array" lang="php">
$nullableArray = TypeAs::nullableArray($mixed);
</code-snippet>
@endverbatim

@verbatim
<code-snippet name="How to type as bool" lang="php">
$bool = TypeAs::bool($mixed);
</code-snippet>
@endverbatim

@verbatim
<code-snippet name="How to FILTER_VALIDATE_BOOL" lang="php">
$filterBool = TypeAs::filterBool($mixed);
</code-snippet>
@endverbatim

@verbatim
<code-snippet name="How to type as nullable bool" lang="php">
$nullableBool = TypeAs::nullableBool($mixed);
</code-snippet>
@endverbatim

@verbatim
<code-snippet name="How to type as class" lang="php">
$class = TypeAs::class(Expected::class, $mixed);
</code-snippet>
@endverbatim

@verbatim
<code-snippet name="How to type as nullable class" lang="php">
$nullableClass = TypeAs::nullableClass(Expected::class, $mixed);
</code-snippet>
@endverbatim

@verbatim
<code-snippet name="How to type as float" lang="php">
$float = TypeAs::float($mixed);
</code-snippet>
@endverbatim

@verbatim
<code-snippet name="How to type as nullable float" lang="php">
$nullableFloat = TypeAs::nullableFloat($mixed);
</code-snippet>
@endverbatim

@verbatim
<code-snippet name="How to type as int" lang="php">
$int = TypeAs::int($mixed);
</code-snippet>
@endverbatim

@verbatim
<code-snippet name="How to type as nullable int" lang="php">
$nullableInt = TypeAs::nullableInt($mixed);
</code-snippet>
@endverbatim

@verbatim
<code-snippet name="How to type as string" lang="php">
$string = TypeAs::string($mixed);
</code-snippet>
@endverbatim

@verbatim
<code-snippet name="How to type as nullable string" lang="php">
$nullableString = TypeAs::nullableString($mixed);
</code-snippet>
@endverbatim
