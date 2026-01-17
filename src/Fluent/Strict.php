<?php

namespace Smpita\TypeAs\Fluent;

use Smpita\TypeAs\Concerns\Fluent\HandlesFluentCalls;
use Smpita\TypeAs\Contracts\ArrayResolver;
use Smpita\TypeAs\Contracts\BoolResolver;
use Smpita\TypeAs\Contracts\ClassResolver;
use Smpita\TypeAs\Contracts\FloatResolver;
use Smpita\TypeAs\Contracts\IntResolver;
use Smpita\TypeAs\Contracts\StringResolver;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\TypeAs;

class Strict
{
    use HandlesFluentCalls;

    /**
     * @throws TypeAsResolutionException
     */
    public function toArray(): array
    {
        return TypeAs::array(
            value: $this->fromValue,
            default: TypeAs::nullableArray($this->defaultTo, wrap: false),
            resolver: TypeAs::nullableClass(ArrayResolver::class, $this->resolveUsing),
            wrap: $this->arrayWrap,
        );
    }

    /**
     * @throws TypeAsResolutionException
     */
    public function toBool(): bool
    {
        return TypeAs::bool(
            value: $this->fromValue,
            default: TypeAs::nullableBool($this->defaultTo),
            resolver: TypeAs::nullableClass(BoolResolver::class, $this->resolveUsing)
        );
    }

    /**
     * @template TClass of object
     *
     * @param  class-string<TClass>  $class
     * @return TClass
     *
     * @throws TypeAsResolutionException
     */
    public function toClass(string $class)
    {
        return TypeAs::class(
            class: $class,
            value: $this->fromValue,
            default: TypeAs::nullableClass(class: $class, value: $this->defaultTo),
            resolver: TypeAs::nullableClass(class: ClassResolver::class, value: $this->resolveUsing)
        );
    }

    /**
     * @throws TypeAsResolutionException
     */
    public function toFloat(): float
    {
        return TypeAs::float(
            value: $this->fromValue,
            default: TypeAs::nullableFloat($this->defaultTo),
            resolver: TypeAs::nullableClass(FloatResolver::class, $this->resolveUsing)
        );
    }

    /**
     * @throws TypeAsResolutionException
     */
    public function toInt(): int
    {
        return TypeAs::int(
            value: $this->fromValue,
            default: TypeAs::nullableInt($this->defaultTo),
            resolver: TypeAs::nullableClass(IntResolver::class, $this->resolveUsing)
        );
    }

    /**
     * @throws TypeAsResolutionException
     */
    public function toString(): string
    {
        return TypeAs::string(
            value: $this->fromValue,
            default: TypeAs::nullableString($this->defaultTo),
            resolver: TypeAs::nullableClass(StringResolver::class, $this->resolveUsing)
        );
    }
}
