<?php

namespace Smpita\TypeAs;

use Smpita\TypeAs\Contracts\ArrayResolver;
use Smpita\TypeAs\Contracts\BoolResolver;
use Smpita\TypeAs\Contracts\ClassResolver;
use Smpita\TypeAs\Contracts\FloatResolver;
use Smpita\TypeAs\Contracts\IntResolver;
use Smpita\TypeAs\Contracts\NullableArrayResolver;
use Smpita\TypeAs\Contracts\NullableBoolResolver;
use Smpita\TypeAs\Contracts\NullableClassResolver;
use Smpita\TypeAs\Contracts\NullableFloatResolver;
use Smpita\TypeAs\Contracts\NullableIntResolver;
use Smpita\TypeAs\Contracts\NullableStringResolver;
use Smpita\TypeAs\Contracts\StringResolver;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\Resolvers\AsArray;
use Smpita\TypeAs\Resolvers\AsBool;
use Smpita\TypeAs\Resolvers\AsClass;
use Smpita\TypeAs\Resolvers\AsFloat;
use Smpita\TypeAs\Resolvers\AsInt;
use Smpita\TypeAs\Resolvers\AsNullableArray;
use Smpita\TypeAs\Resolvers\AsNullableBool;
use Smpita\TypeAs\Resolvers\AsNullableClass;
use Smpita\TypeAs\Resolvers\AsNullableFloat;
use Smpita\TypeAs\Resolvers\AsNullableInt;
use Smpita\TypeAs\Resolvers\AsNullableString;
use Smpita\TypeAs\Resolvers\AsString;

class TypeAs
{
    protected static ?ArrayResolver $arrayResolver = null;

    protected static ?BoolResolver $boolResolver = null;

    protected static ?ClassResolver $classResolver = null;

    protected static ?FloatResolver $floatResolver = null;

    protected static ?IntResolver $intResolver = null;

    protected static ?NullableArrayResolver $nullableArrayResolver = null;

    protected static ?NullableBoolResolver $nullableBoolResolver = null;

    protected static ?NullableClassResolver $nullableClassResolver = null;

    protected static ?NullableFloatResolver $nullableFloatResolver = null;

    protected static ?NullableIntResolver $nullableIntResolver = null;

    protected static ?NullableStringResolver $nullableStringResolver = null;

    protected static ?StringResolver $stringResolver = null;

    /**
     * @throws TypeAsResolutionException
     */
    public static function array(mixed $value, bool|array $wrap = true, ?ArrayResolver $resolver = null): array
    {
        $resolver ??= static::$arrayResolver ?? new AsArray;

        return $resolver->resolve($value, $wrap);
    }

    /**
     * @throws TypeAsResolutionException
     */
    public static function bool(mixed $value, ?bool $default = null, ?BoolResolver $resolver = null): bool
    {
        $resolver ??= static::$boolResolver ?? new AsBool;

        return $resolver->resolve($value, $default);
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
    public static function class(string $class, mixed $value, ?object $default = null, ?ClassResolver $resolver = null)
    {
        $resolver ??= static::$classResolver ?? new AsClass;

        return $resolver->resolve($class, $value, $default);
    }

    /**
     * @throws TypeAsResolutionException
     */
    public static function float(mixed $value, ?float $default = null, ?FloatResolver $resolver = null): float
    {
        $resolver ??= static::$floatResolver ?? new AsFloat;

        return $resolver->resolve($value, $default);
    }

    /**
     * @throws TypeAsResolutionException
     */
    public static function int(mixed $value, ?int $default = null, ?IntResolver $resolver = null): int
    {
        $resolver ??= static::$intResolver ?? new AsInt;

        return $resolver->resolve($value, $default);
    }

    public static function nullableArray(mixed $value, bool|array $wrap = true, ?NullableArrayResolver $resolver = null): ?array
    {
        $resolver ??= static::$nullableArrayResolver ?? new AsNullableArray;

        return $resolver->resolve($value, $wrap);
    }

    public static function nullableBool(mixed $value, ?bool $default = null, ?NullableBoolResolver $resolver = null): ?bool
    {
        $resolver ??= static::$nullableBoolResolver ?? new AsNullableBool;

        return $resolver->resolve($value, $default);
    }

    /**
     * @template TClass of object
     *
     * @param  class-string<TClass>  $class
     * @param  TClass  $default
     * @return TClass|null
     */
    public static function nullableClass(string $class, mixed $value, ?object $default = null, ?NullableClassResolver $resolver = null)
    {
        $resolver ??= static::$nullableClassResolver ?? new AsNullableClass;

        return $resolver->resolve($class, $value, $default);
    }

    public static function nullableFloat(mixed $value, ?float $default = null, ?NullableFloatResolver $resolver = null): ?float
    {
        $resolver ??= static::$nullableFloatResolver ?? new AsNullableFloat;

        return $resolver->resolve($value, $default);
    }

    public static function nullableInt(mixed $value, ?int $default = null, ?NullableIntResolver $resolver = null): ?int
    {
        $resolver ??= static::$nullableIntResolver ?? new AsNullableInt;

        return $resolver->resolve($value, $default);
    }

    public static function nullableString(mixed $value, ?string $default = null, ?NullableStringResolver $resolver = null): ?string
    {
        $resolver ??= static::$nullableStringResolver ?? new AsNullableString;

        return $resolver->resolve($value, $default);
    }

    /**
     * @throws TypeAsResolutionException
     */
    public static function string(mixed $value, ?string $default = null, ?StringResolver $resolver = null): string
    {
        $resolver ??= static::$stringResolver ?? new AsString;

        return $resolver->resolve($value, $default);
    }

    public static function setArrayResolver(?ArrayResolver $resolver): void
    {
        static::$arrayResolver = $resolver;
    }

    public static function setBoolResolver(?BoolResolver $resolver): void
    {
        static::$boolResolver = $resolver;
    }

    public static function setClassResolver(?ClassResolver $resolver): void
    {
        static::$classResolver = $resolver;
    }

    public static function setFloatResolver(?FloatResolver $resolver): void
    {
        static::$floatResolver = $resolver;
    }

    public static function setIntResolver(?IntResolver $resolver): void
    {
        static::$intResolver = $resolver;
    }

    public static function setNullableArrayResolver(?NullableArrayResolver $resolver): void
    {
        static::$nullableArrayResolver = $resolver;
    }

    public static function setNullableBoolResolver(?NullableBoolResolver $resolver): void
    {
        static::$nullableBoolResolver = $resolver;
    }

    public static function setNullableClassResolver(?NullableClassResolver $resolver): void
    {
        static::$nullableClassResolver = $resolver;
    }

    public static function setNullableFloatResolver(?NullableFloatResolver $resolver): void
    {
        static::$nullableFloatResolver = $resolver;
    }

    public static function setNullableIntResolver(?NullableIntResolver $resolver): void
    {
        static::$nullableIntResolver = $resolver;
    }

    public static function setNullableStringResolver(?NullableStringResolver $resolver): void
    {
        static::$nullableStringResolver = $resolver;
    }

    public static function setStringResolver(?StringResolver $resolver): void
    {
        static::$stringResolver = $resolver;
    }

    public static function useDefaultResolvers(): void
    {
        self::setArrayResolver(null);
        self::setNullableBoolResolver(null);
        self::setClassResolver(null);
        self::setFloatResolver(null);
        self::setIntResolver(null);
        self::setNullableArrayResolver(null);
        self::setNullableClassResolver(null);
        self::setNullableFloatResolver(null);
        self::setNullableIntResolver(null);
        self::setNullableStringResolver(null);
        self::setStringResolver(null);
    }
}
