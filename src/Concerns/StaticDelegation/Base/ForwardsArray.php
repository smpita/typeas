<?php

namespace Smpita\TypeAs\Concerns\StaticDelegation\Base;

use Smpita\TypeAs\Concerns\Instance\HandlesTypeFactory;
use Smpita\TypeAs\Contracts\ArrayResolver;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;

trait ForwardsArray
{
    use HandlesTypeFactory;

    /**
     * @throws TypeAsResolutionException
     */
    public static function array(mixed $value, ?array $default = null, ?ArrayResolver $resolver = null, ?bool $wrap = true): array
    {
        return static::getInstance()->array(value: $value, default: $default, resolver: $resolver, wrap: $wrap);
    }

    public static function nullableArray(mixed $value, ?array $default = null, ?ArrayResolver $resolver = null, ?bool $wrap = true): ?array
    {
        return static::getInstance()->nullableArray(value: $value, default: $default, resolver: $resolver, wrap: $wrap);
    }

    public static function setArrayResolver(?ArrayResolver $resolver): void
    {
        static::getInstance()->setArrayResolver($resolver);
    }
}
