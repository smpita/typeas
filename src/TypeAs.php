<?php

namespace Smpita\TypeAs;

use DateTimeZone;
use Illuminate\Support\Carbon;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\Types\AsArray;
use Smpita\TypeAs\Types\AsCarbon;
use Smpita\TypeAs\Types\AsClass;
use Smpita\TypeAs\Types\AsFloat;
use Smpita\TypeAs\Types\AsInt;
use Smpita\TypeAs\Types\AsNullableArray;
use Smpita\TypeAs\Types\AsNullableCarbon;
use Smpita\TypeAs\Types\AsNullableClass;
use Smpita\TypeAs\Types\AsNullableFloat;
use Smpita\TypeAs\Types\AsNullableInt;
use Smpita\TypeAs\Types\AsNullableString;
use Smpita\TypeAs\Types\AsString;

class TypeAs
{
    /**
     * @throws TypeAsResolutionException
     */
    public static function array(mixed $value, bool|array $wrap = true): array
    {
        return (new AsArray)->handle($value, $wrap);
    }

    /**
     * @throws TypeAsResolutionException
     */
    public static function carbon(mixed $value, DateTimeZone|string $tz = null, Carbon $default = null): Carbon
    {
        return (new AsCarbon)->handle($value, $tz, $default);
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
    public static function class(string $class, mixed $value, object $default = null): object
    {
        return (new AsClass)->handle($class, $value, $default);
    }

    /**
     * @throws TypeAsResolutionException
     */
    public static function float(mixed $value, float $default = null): float
    {
        return (new AsFloat)->handle($value, $default);
    }

    /**
     * @throws TypeAsResolutionException
     */
    public static function int(mixed $value, int $default = null): int
    {
        return (new AsInt)->handle($value, $default);
    }

    public static function nullableArray(mixed $value, bool|array $wrap = true): ?array
    {
        return (new AsNullableArray)->handle($value, $wrap);
    }

    public static function nullableCarbon(mixed $value, DateTimeZone|string $tz = null, Carbon $default = null): ?Carbon
    {
        return (new AsNullableCarbon)->handle($value, $tz, $default);
    }

    /**
     * @template TClass of object
     *
     * @param  class-string<TClass>  $class
     * @param  TClass  $default
     * @return TClass|null
     */
    public static function nullableClass(string $class, mixed $value, object $default = null): ?object
    {
        return (new AsNullableClass)->handle($class, $value, $default);
    }

    public static function nullableFloat(mixed $value, float $default = null): ?float
    {
        return (new AsNullableFloat)->handle($value, $default);
    }

    public static function nullableInt(mixed $value, int $default = null): ?int
    {
        return (new AsNullableInt)->handle($value, $default);
    }

    public static function nullableString(mixed $value, string $default = null): ?string
    {
        return (new AsNullableString)->handle($value, $default);
    }

    /**
     * @throws TypeAsResolutionException
     */
    public static function string(mixed $value, string $default = null): string
    {
        return (new AsString)->handle($value, $default);
    }
}
