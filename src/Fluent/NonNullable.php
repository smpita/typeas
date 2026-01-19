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

class NonNullable
{
    use HandlesFluentCalls;

    /**
     * @throws TypeAsResolutionException
     */
    public function toArray(): array
    {
        return TypeAs::array(
            value: $this->config()->fromValue,
            default: TypeAs::nullableArray($this->config()->defaultTo, wrap: false),
            resolver: TypeAs::nullableClass(ArrayResolver::class, $this->config()->resolveUsing),
            wrap: $this->config()->arrayWrap,
        );
    }

    /**
     * @throws TypeAsResolutionException
     */
    public function toBool(): bool
    {
        return TypeAs::bool(
            value: $this->config()->fromValue,
            default: TypeAs::nullableBool($this->config()->defaultTo),
            resolver: TypeAs::nullableClass(BoolResolver::class, $this->config()->resolveUsing)
        );
    }

    /**
     * @throws TypeAsResolutionException
     */
    public function toFilterBool(): ?bool
    {
        return TypeAs::filterBool(
            value: $this->config()->fromValue,
            default: TypeAs::nullableBool($this->config()->defaultTo),
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
            value: $this->config()->fromValue,
            default: TypeAs::nullableClass(class: $class, value: $this->config()->defaultTo),
            resolver: TypeAs::nullableClass(class: ClassResolver::class, value: $this->config()->resolveUsing)
        );
    }

    /**
     * @throws TypeAsResolutionException
     */
    public function toFloat(): float
    {
        return TypeAs::float(
            value: $this->config()->fromValue,
            default: TypeAs::nullableFloat($this->config()->defaultTo),
            resolver: TypeAs::nullableClass(FloatResolver::class, $this->config()->resolveUsing)
        );
    }

    /**
     * @throws TypeAsResolutionException
     */
    public function toInt(): int
    {
        return TypeAs::int(
            value: $this->config()->fromValue,
            default: TypeAs::nullableInt($this->config()->defaultTo),
            resolver: TypeAs::nullableClass(IntResolver::class, $this->config()->resolveUsing)
        );
    }

    /**
     * @throws TypeAsResolutionException
     */
    public function toString(): string
    {
        return TypeAs::string(
            value: $this->config()->fromValue,
            default: TypeAs::nullableString($this->config()->defaultTo),
            resolver: TypeAs::nullableClass(StringResolver::class, $this->config()->resolveUsing)
        );
    }
}
