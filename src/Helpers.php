<?php

namespace Smpita\TypeAs;

use DateTimeZone;
use Illuminate\Support\Carbon;
use Smpita\TypeAs\Contracts\ArrayResolver;
use Smpita\TypeAs\Contracts\ClassResolver;
use Smpita\TypeAs\Contracts\FloatResolver;
use Smpita\TypeAs\Contracts\IntResolver;
use Smpita\TypeAs\Contracts\NullableArrayResolver;
use Smpita\TypeAs\Contracts\NullableCarbonResolver;
use Smpita\TypeAs\Contracts\NullableClassResolver;
use Smpita\TypeAs\Contracts\NullableFloatResolver;
use Smpita\TypeAs\Contracts\NullableIntResolver;
use Smpita\TypeAs\Contracts\NullableStringResolver;
use Smpita\TypeAs\Contracts\StringResolver;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;

/**
 * @throws TypeAsResolutionException
 */
function asArray(mixed $value, bool|array $wrap = true, ArrayResolver $resolver = null): array
{
    return TypeAs::array($value, $wrap, $resolver);
}

/**
 * @template TClass of object
 *
 * @param  class-string<TClass>  $class
 * @param  TClass  $default
 * @return TClass
 *
 * @throws TypeAsResolutionException
 */
function asClass(string $class, mixed $value, object $default = null, ClassResolver $resolver = null)
{
    return TypeAs::class($class, $value, $default, $resolver);
}

/**
 * @throws TypeAsResolutionException
 */
function asFloat(mixed $value, float $default = null, FloatResolver $resolver = null): float
{
    return TypeAs::float($value, $default, $resolver);
}

/**
 * @throws TypeAsResolutionException
 */
function asInt(mixed $value, int $default = null, IntResolver $resolver = null): int
{
    return TypeAs::int($value, $default, $resolver);
}

function asNullableArray(mixed $value, bool|array $wrap = true, NullableArrayResolver $resolver = null): ?array
{
    return TypeAs::nullableArray($value, $wrap, $resolver);
}

function asNullableCarbon(mixed $value, DateTimeZone|string $tz = null, Carbon $default = null, NullableCarbonResolver $resolver = null): ?Carbon
{
    return TypeAs::nullableCarbon($value, $tz, $default, $resolver);
}

/**
 * @template TClass of object
 *
 * @param  class-string<TClass>  $class
 * @param  TClass  $default
 * @return TClass|null
 */
function asNullableClass(string $class, mixed $value, object $default = null, NullableClassResolver $resolver = null)
{
    return TypeAs::nullableClass($class, $value, $default, $resolver);
}

function asNullableFloat(mixed $value, float $default = null, NullableFloatResolver $resolver = null): ?float
{
    return TypeAs::nullableFloat($value, $default, $resolver);
}

function asNullableInt(mixed $value, int $default = null, NullableIntResolver $resolver = null): ?int
{
    return TypeAs::nullableInt($value, $default, $resolver);
}

function asNullableString(mixed $value, string $default = null, NullableStringResolver $resolver = null): ?string
{
    return TypeAs::nullableString($value, $default, $resolver);
}

/**
 * @throws TypeAsResolutionException
 */
function asString(mixed $value, string $default = null, StringResolver $resolver = null): string
{
    return TypeAs::string($value, $default, $resolver);
}
