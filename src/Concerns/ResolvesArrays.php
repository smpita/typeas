<?php

namespace Smpita\TypeAs\Concerns;

use Smpita\TypeAs\Contracts\ArrayResolver;
use Smpita\TypeAs\Contracts\NullableArrayResolver;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\Resolvers\AsArray;
use Smpita\TypeAs\Resolvers\AsNullableArray;

trait ResolvesArrays
{
    protected static ?ArrayResolver $arrayResolver = null;

    protected static ?NullableArrayResolver $nullableArrayResolver = null;

    /**
     * @throws TypeAsResolutionException
     */
    public static function array(mixed $value, ?array $default = null, ?ArrayResolver $resolver = null, ?bool $wrap = true): array
    {
        $resolver ??= static::$arrayResolver ?? new AsArray;

        return $resolver->resolve($value, $default, $wrap);
    }

    public static function nullableArray(mixed $value, ?array $default = null, ?NullableArrayResolver $resolver = null, ?bool $wrap = true): ?array
    {
        $resolver ??= static::$nullableArrayResolver ?? new AsNullableArray;

        return $resolver->resolve($value, $default, $wrap);
    }

    public static function setArrayResolver(?ArrayResolver $resolver): void
    {
        static::$arrayResolver = $resolver;
    }

    public static function setNullableArrayResolver(?NullableArrayResolver $resolver): void
    {
        static::$nullableArrayResolver = $resolver;
    }
}
