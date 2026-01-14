<?php

namespace Smpita\TypeAs\Concerns;

use Smpita\TypeAs\Contracts\IntResolver;
use Smpita\TypeAs\Contracts\NullableIntResolver;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\Resolvers\AsInt;
use Smpita\TypeAs\Resolvers\AsNullableInt;

trait ResolvesInts
{
    protected static ?IntResolver $intResolver = null;

    protected static ?NullableIntResolver $nullableIntResolver = null;

    /**
     * @throws TypeAsResolutionException
     */
    public static function int(mixed $value, ?int $default = null, ?IntResolver $resolver = null): int
    {
        $resolver ??= static::$intResolver ?? new AsInt();

        return $resolver->resolve($value, $default);
    }

    public static function nullableInt(mixed $value, ?int $default = null, ?NullableIntResolver $resolver = null): ?int
    {
        $resolver ??= static::$nullableIntResolver ?? new AsNullableInt();

        return $resolver->resolve($value, $default);
    }

    public static function setIntResolver(?IntResolver $resolver): void
    {
        static::$intResolver = $resolver;
    }

    public static function setNullableIntResolver(?NullableIntResolver $resolver): void
    {
        static::$nullableIntResolver = $resolver;
    }
}
