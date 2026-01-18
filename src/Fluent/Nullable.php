<?php

namespace Smpita\TypeAs\Fluent;

use Smpita\TypeAs\Concerns\Fluent\HandlesFluentCalls;
use Smpita\TypeAs\Contracts\NullableArrayResolver;
use Smpita\TypeAs\Contracts\NullableBoolResolver;
use Smpita\TypeAs\Contracts\NullableClassResolver;
use Smpita\TypeAs\Contracts\NullableFloatResolver;
use Smpita\TypeAs\Contracts\NullableIntResolver;
use Smpita\TypeAs\Contracts\NullableStringResolver;
use Smpita\TypeAs\TypeAs;

class Nullable
{
    use HandlesFluentCalls;

    public function toArray(): ?array
    {
        return TypeAs::nullableArray(
            value: $this->config->fromValue,
            default: TypeAs::nullableArray($this->config->defaultTo, wrap: false),
            resolver: TypeAs::nullableClass(NullableArrayResolver::class, $this->config->resolveUsing),
            wrap: $this->config->arrayWrap,
        );
    }

    public function toBool(): ?bool
    {
        return TypeAs::nullableBool(
            value: $this->config->fromValue,
            default: TypeAs::nullableBool($this->config->defaultTo),
            resolver: TypeAs::nullableClass(NullableBoolResolver::class, $this->config->resolveUsing)
        );
    }

    public function toFilterBool(): ?bool
    {
        return TypeAs::nullableFilterBool(
            value: $this->config->fromValue,
            default: TypeAs::nullableBool($this->config->defaultTo),
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
            value: $this->config->fromValue,
            default: TypeAs::nullableClass(class: $class, value: $this->config->defaultTo),
            resolver: TypeAs::nullableClass(class: NullableClassResolver::class, value: $this->config->resolveUsing)
        );
    }

    public function toFloat(): ?float
    {
        return TypeAs::nullableFloat(
            value: $this->config->fromValue,
            default: TypeAs::nullableFloat($this->config->defaultTo),
            resolver: TypeAs::nullableClass(NullableFloatResolver::class, $this->config->resolveUsing)
        );
    }

    public function toInt(): ?int
    {
        return TypeAs::nullableInt(
            value: $this->config->fromValue,
            default: TypeAs::nullableInt($this->config->defaultTo),
            resolver: TypeAs::nullableClass(NullableIntResolver::class, $this->config->resolveUsing)
        );
    }

    public function toString(): ?string
    {
        return TypeAs::nullableString(
            value: $this->config->fromValue,
            default: TypeAs::nullableString($this->config->defaultTo),
            resolver: TypeAs::nullableClass(NullableStringResolver::class, $this->config->resolveUsing)
        );
    }
}
