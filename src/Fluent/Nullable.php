<?php

namespace Smpita\TypeAs\Fluent;

use Smpita\TypeAs\Concerns\Fluent\HandlesFluentCalls;
use Smpita\TypeAs\TypeAs;

class Nullable
{
    use HandlesFluentCalls;

    public function toArray(): ?array
    {
        return TypeAs::nullableArray(
            value: $this->config()->fromValue,
            default: TypeAs::nullableArray($this->config()->defaultTo, wrap: false),
            resolver: $this->config()->nullableArrayResolver,
            wrap: $this->config()->arrayWrap,
        );
    }

    public function toBool(): ?bool
    {
        return TypeAs::nullableBool(
            value: $this->config()->fromValue,
            default: TypeAs::nullableBool($this->config()->defaultTo),
            resolver: $this->config()->nullableBoolResolver,
        );
    }

    public function toFilterBool(): ?bool
    {
        return TypeAs::nullableFilterBool(
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
    public function toClass(string $class)
    {
        return TypeAs::nullableClass(
            class: $class,
            value: $this->config()->fromValue,
            default: TypeAs::nullableClass(class: $class, value: $this->config()->defaultTo),
            resolver: $this->config()->nullableClassResolver,
        );
    }

    public function toFloat(): ?float
    {
        return TypeAs::nullableFloat(
            value: $this->config()->fromValue,
            default: TypeAs::nullableFloat($this->config()->defaultTo),
            resolver: $this->config()->nullableFloatResolver,
        );
    }

    public function toInt(): ?int
    {
        return TypeAs::nullableInt(
            value: $this->config()->fromValue,
            default: TypeAs::nullableInt($this->config()->defaultTo),
            resolver: $this->config()->nullableIntResolver,
        );
    }

    public function toString(): ?string
    {
        return TypeAs::nullableString(
            value: $this->config()->fromValue,
            default: TypeAs::nullableString($this->config()->defaultTo),
            resolver: $this->config()->nullableStringResolver,
        );
    }
}
