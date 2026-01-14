<?php

namespace Smpita\TypeAs\Concerns;

use Smpita\TypeAs\Contracts\ClassResolver;
use Smpita\TypeAs\Contracts\NullableClassResolver;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\Resolvers\AsClass;
use Smpita\TypeAs\Resolvers\AsNullableClass;

trait ResolvesClasses
{
    protected static ?ClassResolver $classResolver = null;

    protected static ?NullableClassResolver $nullableClassResolver = null;

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
        $resolver ??= static::$classResolver ?? new AsClass();

        return $resolver->resolve($class, $value, $default);
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
        $resolver ??= static::$nullableClassResolver ?? new AsNullableClass();

        return $resolver->resolve($class, $value, $default);
    }

    public static function setClassResolver(?ClassResolver $resolver): void
    {
        static::$classResolver = $resolver;
    }

    public static function setNullableClassResolver(?NullableClassResolver $resolver): void
    {
        static::$nullableClassResolver = $resolver;
    }
}
