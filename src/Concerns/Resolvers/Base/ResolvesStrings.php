<?php

namespace Smpita\TypeAs\Concerns\Resolvers\Base;

use Smpita\TypeAs\Contracts\NullableStringResolver;
use Smpita\TypeAs\Contracts\StringResolver;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\Resolvers\Base\AsNullableString;
use Smpita\TypeAs\Resolvers\Base\AsString;

trait ResolvesStrings
{
    protected static ?StringResolver $stringResolver = null;

    protected static ?NullableStringResolver $nullableStringResolver = null;

    /**
     * @throws TypeAsResolutionException
     */
    public static function string(mixed $value, ?string $default = null, ?StringResolver $resolver = null): string
    {
        $resolver ??= static::$stringResolver ?? new AsString();

        return $resolver->resolve($value, $default);
    }

    public static function nullableString(mixed $value, ?string $default = null, ?NullableStringResolver $resolver = null): ?string
    {
        $resolver ??= static::$nullableStringResolver ?? new AsNullableString();

        return $resolver->resolve($value, $default);
    }

    public static function setStringResolver(?StringResolver $resolver): void
    {
        static::$stringResolver = $resolver;
    }

    public static function setNullableStringResolver(?NullableStringResolver $resolver): void
    {
        static::$nullableStringResolver = $resolver;
    }
}
