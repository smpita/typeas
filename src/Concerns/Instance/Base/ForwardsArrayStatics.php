<?php

namespace Smpita\TypeAs\Concerns\Instance\Base;

use Smpita\TypeAs\Concerns\Instance\HandlesTypeAsService;
use Smpita\TypeAs\Contracts\ArrayResolver;
use Smpita\TypeAs\Contracts\NullableArrayResolver;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;

trait ForwardsArrayStatics
{
    use HandlesTypeAsService;

    /**
     * @throws TypeAsResolutionException
     */
    public static function array(mixed $value, ?array $default = null, ?ArrayResolver $resolver = null, ?bool $wrap = true): array
    {
        return static::getInstance()->array(value: $value, default: $default, resolver: $resolver, wrap: $wrap);
    }

    public static function nullableArray(mixed $value, ?array $default = null, ?NullableArrayResolver $resolver = null, ?bool $wrap = true): ?array
    {
        return static::getInstance()->nullableArray(value: $value, default: $default, resolver: $resolver, wrap: $wrap);
    }

    public static function setArrayResolver(?ArrayResolver $resolver): void
    {
        static::getInstance()->setArrayResolver($resolver);
    }

    public static function setNullableArrayResolver(?NullableArrayResolver $resolver): void
    {
        static::getInstance()->setNullableArrayResolver($resolver);
    }
}
