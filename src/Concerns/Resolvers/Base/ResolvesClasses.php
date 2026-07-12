<?php

namespace Smpita\TypeAs\Concerns\Resolvers\Base;

use Smpita\TypeAs\Concerns\ThrowsTypeAsResolutionExceptions;
use Smpita\TypeAs\Contracts\ClassResolver;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\Resolvers\Base\AsClass;
use Smpita\TypeAs\Resolvers\Base\AsNullableClass;

trait ResolvesClasses
{
    use ThrowsTypeAsResolutionExceptions;

    protected ?ClassResolver $classResolver = null;

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
        $resolver ??= $this->classResolver ??= new AsClass();

        return $resolver->resolve(class: $class, value: $value, default: $default) ?? static::throwResolutionException($value, $resolver);
    }

    /**
     * @template TClass of object
     *
     * @param  class-string<TClass>  $class
     * @param  TClass  $default
     * @return TClass|null
     */
    public function nullableClass(string $class, mixed $value, ?object $default = null, ?ClassResolver $resolver = null)
    {
        $resolver ??= $this->classResolver ??= new AsNullableClass();

        return $resolver->resolve(class: $class, value: $value, default: $default);
    }

    public function setClassResolver(?ClassResolver $resolver): void
    {
        $this->classResolver = $resolver;
    }
}
