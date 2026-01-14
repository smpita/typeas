<?php

namespace Smpita\TypeAs\Concerns\Resolvers\Base;

use Smpita\TypeAs\Resolvers\Base\AsBool;
use Smpita\TypeAs\Contracts\BoolResolver;
use Smpita\TypeAs\Resolvers\Base\AsNullableBool;
use Smpita\TypeAs\Contracts\NullableBoolResolver;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;

trait ResolvesBools
{
    protected static ?BoolResolver $boolResolver = null;

    protected static ?NullableBoolResolver $nullableBoolResolver = null;

    /**
     * @throws TypeAsResolutionException
     */
    public static function bool(mixed $value, ?bool $default = null, ?BoolResolver $resolver = null): bool
    {
        $resolver ??= static::$boolResolver ?? new AsBool();

        return $resolver->resolve($value, $default);
    }

    public static function nullableBool(mixed $value, ?bool $default = null, ?NullableBoolResolver $resolver = null): ?bool
    {
        $resolver ??= static::$nullableBoolResolver ?? new AsNullableBool();

        return $resolver->resolve($value, $default);
    }

    public static function setBoolResolver(?BoolResolver $resolver): void
    {
        static::$boolResolver = $resolver;
    }

    public static function setNullableBoolResolver(?NullableBoolResolver $resolver): void
    {
        static::$nullableBoolResolver = $resolver;
    }
}
