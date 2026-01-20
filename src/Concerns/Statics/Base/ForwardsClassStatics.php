<?php

namespace Smpita\TypeAs\Concerns\Statics\Base;

use Smpita\TypeAs\Concerns\Instance\HandlesTypeFactory;
use Smpita\TypeAs\Contracts\ClassResolver;
use Smpita\TypeAs\Contracts\NullableClassResolver;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;

trait ForwardsClassStatics
{
    use HandlesTypeFactory;

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
        return static::getInstance()->class(class: $class, value: $value, default: $default, resolver: $resolver);
    }

    /**
     * @template TClass of object
     *
     * @param  class-string<TClass>  $class
     * @param  TClass  $default
     * @return TClass|null
     *
     * @throws TypeAsResolutionException
     */
    public static function nullableClass(string $class, mixed $value, ?object $default = null, ?NullableClassResolver $resolver = null)
    {
        return static::getInstance()->nullableClass(class: $class, value: $value, default: $default, resolver: $resolver);
    }

    public static function setClassResolver(?ClassResolver $resolver): void
    {
        static::getInstance()->setClassResolver($resolver);
    }

    public static function setNullableClassResolver(?NullableClassResolver $resolver): void
    {
        static::getInstance()->setNullableClassResolver($resolver);
    }
}
