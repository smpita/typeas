<?php

namespace Smpita\TypeAs;

use DateTimeZone;
use Illuminate\Support\Carbon;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\Types\AsArray;
use Smpita\TypeAs\Types\AsCarbon;
use Smpita\TypeAs\Types\AsClass;
use Smpita\TypeAs\Types\AsFloat;
use Smpita\TypeAs\Types\AsInteger;
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
    public static function class(mixed $value, string $class, object $default = null): object
    {
        return (new AsClass)->handle($value, $class, $default);
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
        return (new AsInteger)->handle($value, $default);
    }

    /**
     * @throws TypeAsResolutionException
     */
    public static function string(mixed $value, string $default = null): string
    {
        return (new AsString)->handle($value, $default);
    }
}
