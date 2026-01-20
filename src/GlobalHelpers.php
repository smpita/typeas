<?php

use Smpita\TypeAs\TypeAs;
use Smpita\TypeAs\Fluent\NonNullable;
use Smpita\TypeAs\Contracts\IntResolver;
use Smpita\TypeAs\Contracts\BoolResolver;
use Smpita\TypeAs\Contracts\ArrayResolver;
use Smpita\TypeAs\Contracts\ClassResolver;
use Smpita\TypeAs\Contracts\FloatResolver;
use Smpita\TypeAs\Contracts\StringResolver;
use Smpita\TypeAs\Contracts\NullableIntResolver;
use Smpita\TypeAs\Contracts\NullableBoolResolver;
use Smpita\TypeAs\Contracts\NullableArrayResolver;
use Smpita\TypeAs\Contracts\NullableClassResolver;
use Smpita\TypeAs\Contracts\NullableFloatResolver;
use Smpita\TypeAs\Contracts\NullableStringResolver;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;

if (!function_exists('type')) {
    function type(mixed $value): NonNullable
    {
        return TypeAs::type($value);
    }
}

if (!function_exists('asArray')) {
    /**
     * @throws TypeAsResolutionException
     */
    function asArray(mixed $value, ?array $default = null, ?ArrayResolver $resolver = null, ?bool $wrap = true): array
    {
        return TypeAs::array($value, $default, $resolver, $wrap);
    }
}

if (!function_exists('asNullableArray')) {
    function asNullableArray(mixed $value, ?array $default = null, ?NullableArrayResolver $resolver = null, ?bool $wrap = true): ?array
    {
        return TypeAs::nullableArray($value, $default, $resolver, $wrap);
    }
}

if (!function_exists('asBool')) {
    /**
     * @throws TypeAsResolutionException
     */
    function asBool(mixed $value, ?bool $default = null, ?BoolResolver $resolver = null): bool
    {
        return TypeAs::bool($value, $default, $resolver);
    }
}

if (!function_exists('asNullableBool')) {
    function asNullableBool(mixed $value, ?bool $default = null, ?NullableBoolResolver $resolver = null): ?bool
    {
        return TypeAs::nullableBool($value, $default, $resolver);
    }
}

if (!function_exists('asFilterBool')) {
    function asFilterBool(mixed $value, ?bool $default = null): bool
    {
        return TypeAs::filterBool($value, $default);
    }
}

if (!function_exists('asNullableFilterBool')) {
    function asNullableFilterBool(mixed $value, ?bool $default = null): ?bool
    {
        return TypeAs::nullableFilterBool($value, $default);
    }
}

if (!function_exists('asClass')) {
    /**
     * @template TClass of object
     *
     * @param  class-string<TClass>  $class
     * @param  TClass  $default
     * @return TClass
     *
     * @throws TypeAsResolutionException
     */
    function asClass(string $class, mixed $value, ?object $default = null, ?ClassResolver $resolver = null)
    {
        return TypeAs::class($class, $value, $default, $resolver);
    }
}

if (!function_exists('asNullableClass')) {
    /**
     * @template TClass of object
     *
     * @param  class-string<TClass>  $class
     * @param  TClass  $default
     * @return TClass|null
     */
    function asNullableClass(string $class, mixed $value, ?object $default = null, ?NullableClassResolver $resolver = null)
    {
        return TypeAs::nullableClass($class, $value, $default, $resolver);
    }
}

if (!function_exists('asFloat')) {
    /**
     * @throws TypeAsResolutionException
     */
    function asFloat(mixed $value, ?float $default = null, ?FloatResolver $resolver = null): float
    {
        return TypeAs::float($value, $default, $resolver);
    }
}

if (!function_exists('asNullableFloat')) {
    function asNullableFloat(mixed $value, ?float $default = null, ?NullableFloatResolver $resolver = null): ?float
    {
        return TypeAs::nullableFloat($value, $default, $resolver);
    }
}

if (!function_exists('asInt')) {
    /**
     * @throws TypeAsResolutionException
     */
    function asInt(mixed $value, ?int $default = null, ?IntResolver $resolver = null): int
    {
        return TypeAs::int($value, $default, $resolver);
    }
}

if (!function_exists('asNullableInt')) {
    function asNullableInt(mixed $value, ?int $default = null, ?NullableIntResolver $resolver = null): ?int
    {
        return TypeAs::nullableInt($value, $default, $resolver);
    }
}

if (!function_exists('asNullableString')) {
    function asNullableString(mixed $value, ?string $default = null, ?NullableStringResolver $resolver = null): ?string
    {
        return TypeAs::nullableString($value, $default, $resolver);
    }
}

if (!function_exists('asString')) {
    /**
     * @throws TypeAsResolutionException
     */
    function asString(mixed $value, ?string $default = null, ?StringResolver $resolver = null): string
    {
        return TypeAs::string($value, $default, $resolver);
    }
}