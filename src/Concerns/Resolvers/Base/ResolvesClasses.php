<?php

namespace Smpita\TypeAs\Concerns\Resolvers\Base;

use Smpita\TypeAs\Contracts\ClassResolver;
use Smpita\TypeAs\Contracts\NullableClassResolver;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\Resolvers\Base\AsClass;
use Smpita\TypeAs\Resolvers\Base\AsNullableClass;

trait ResolvesClasses
{
    protected ?ClassResolver $classResolver = null;

    protected ?NullableClassResolver $nullableClassResolver = null;

    /**
     * @template TClass of object
     *
     * @param  class-string<TClass>  $class
     * @param  TClass  $default
     * @return TClass
     *
     * @throws TypeAsResolutionException
     */
    public function class(string $class, mixed $value, ?object $default = null, ?ClassResolver $resolver = null)
    {
        $resolver ??= $this->classResolver ??= new AsClass;

        return $resolver->resolve($class, $value, $default);
    }

    /**
     * @template TClass of object
     *
     * @param  class-string<TClass>  $class
     * @param  TClass  $default
     * @return TClass|null
     */
    public function nullableClass(string $class, mixed $value, ?object $default = null, ?NullableClassResolver $resolver = null)
    {
        $resolver ??= $this->nullableClassResolver ??= new AsNullableClass;

        return $resolver->resolve($class, $value, $default);
    }

    public function setClassResolver(?ClassResolver $resolver): void
    {
        $this->classResolver = $resolver;
    }

    public function setNullableClassResolver(?NullableClassResolver $resolver): void
    {
        $this->nullableClassResolver = $resolver;
    }
}
