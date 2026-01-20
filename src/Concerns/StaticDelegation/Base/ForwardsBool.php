<?php

namespace Smpita\TypeAs\Concerns\StaticDelegation\Base;

use Smpita\TypeAs\Concerns\Instance\HandlesTypeFactory;
use Smpita\TypeAs\Contracts\BoolResolver;
use Smpita\TypeAs\Contracts\NullableBoolResolver;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;

trait ForwardsBool
{
    use HandlesTypeFactory;

    /**
     * @throws TypeAsResolutionException
     */
    public static function bool(mixed $value, ?bool $default = null, ?BoolResolver $resolver = null): bool
    {
        return static::getInstance()->bool(value: $value, default: $default, resolver: $resolver);
    }

    public static function nullableBool(mixed $value, ?bool $default = null, ?NullableBoolResolver $resolver = null): ?bool
    {
        return static::getInstance()->nullableBool(value: $value, default: $default, resolver: $resolver);
    }

    public static function setBoolResolver(?BoolResolver $resolver): void
    {
        static::getInstance()->setBoolResolver($resolver);
    }

    public static function setNullableBoolResolver(?NullableBoolResolver $resolver): void
    {
        static::getInstance()->setNullableBoolResolver($resolver);
    }
}
