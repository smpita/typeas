<?php

namespace Smpita\TypeAs\Concerns\Instance\Base;

use Smpita\TypeAs\Concerns\Instance\HandlesTypeFactory;
use Smpita\TypeAs\Contracts\NullableStringResolver;
use Smpita\TypeAs\Contracts\StringResolver;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;

trait ForwardsStringStatics
{
    use HandlesTypeFactory;

    /**
     * @throws TypeAsResolutionException
     */
    public static function string(mixed $value, ?string $default = null, ?StringResolver $resolver = null): string
    {
        return static::getInstance()->string(value: $value, default: $default, resolver: $resolver);
    }

    public static function nullableString(mixed $value, ?string $default = null, ?NullableStringResolver $resolver = null): ?string
    {
        return static::getInstance()->nullableString(value: $value, default: $default, resolver: $resolver);
    }

    public static function setStringResolver(?StringResolver $resolver): void
    {
        static::getInstance()->setStringResolver($resolver);
    }

    public static function setNullableStringResolver(?NullableStringResolver $resolver): void
    {
        static::getInstance()->setNullableStringResolver($resolver);
    }
}
