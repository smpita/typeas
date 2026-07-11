<?php

namespace Smpita\TypeAs\Fluent;

use Smpita\TypeAs\Concerns\Fluent\HandlesFluentCalls;
use Smpita\TypeAs\TypeAs;

class Nullable
{
    use HandlesFluentCalls;

    public function asArray(): ?array
    {
        return TypeAs::onError(
            message: $this->config()->throwMessage,
            exception: $this->config()->throwException,
        )->nullableArray(
            value: $this->config()->fromValue,
            default: TypeAs::nullableArray($this->config()->defaultTo, wrap: false),
            resolver: $this->config()->arrayResolver,
            wrap: $this->config()->arrayWrap,
        );
    }

    public function asBool(): ?bool
    {
        return TypeAs::onError(
            message: $this->config()->throwMessage,
            exception: $this->config()->throwException,
        )->nullableBool(
            value: $this->config()->fromValue,
            default: TypeAs::nullableBool($this->config()->defaultTo),
            resolver: $this->config()->boolResolver,
        );
    }

    public function asFilterBool(): ?bool
    {
        return TypeAs::onError(
            message: $this->config()->throwMessage,
            exception: $this->config()->throwException,
        )->nullableFilterBool(
            value: $this->config()->fromValue,
            default: TypeAs::nullableBool($this->config()->defaultTo),
        );
    }

    /**
     * @template TClass of object
     *
     * @param  class-string<TClass>  $class
     * @return TClass|null
     */
    public function asClass(string $class)
    {
        return TypeAs::onError(
            message: $this->config()->throwMessage,
            exception: $this->config()->throwException,
        )->nullableClass(
            class: $class,
            value: $this->config()->fromValue,
            default: TypeAs::nullableClass(class: $class, value: $this->config()->defaultTo),
            resolver: $this->config()->classResolver,
        );
    }

    public function asFloat(): ?float
    {
        return TypeAs::onError(
            message: $this->config()->throwMessage,
            exception: $this->config()->throwException,
        )->nullableFloat(
            value: $this->config()->fromValue,
            default: TypeAs::nullableFloat($this->config()->defaultTo),
            resolver: $this->config()->floatResolver,
        );
    }

    public function asInt(): ?int
    {
        return TypeAs::onError(
            message: $this->config()->throwMessage,
            exception: $this->config()->throwException,
        )->nullableInt(
            value: $this->config()->fromValue,
            default: TypeAs::nullableInt($this->config()->defaultTo),
            resolver: $this->config()->intResolver,
        );
    }

    public function asString(): ?string
    {
        return TypeAs::onError(
            message: $this->config()->throwMessage,
            exception: $this->config()->throwException,
        )->nullableString(
            value: $this->config()->fromValue,
            default: TypeAs::nullableString($this->config()->defaultTo),
            resolver: $this->config()->stringResolver,
        );
    }
}
