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
            value: $this->fromValue,
            default: TypeAs::nullableArray($this->defaultTo, wrap: false),
            resolver: TypeAs::nullableClass(NullableArrayResolver::class, $this->resolveUsing),
            wrap: $this->arrayWrap,
        );
    }

    public function toBool(): ?bool
    {
        return TypeAs::nullableBool(
            value: $this->fromValue,
            default: TypeAs::nullableBool($this->defaultTo),
            resolver: TypeAs::nullableClass(NullableBoolResolver::class, $this->resolveUsing)
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
            value: $this->fromValue,
            default: TypeAs::nullableClass(class: $class, value: $this->defaultTo),
            resolver: TypeAs::nullableClass(class: NullableClassResolver::class, value: $this->resolveUsing)
        );
    }

    public function toFloat(): ?float
    {
        return TypeAs::nullableFloat(
            value: $this->fromValue,
            default: TypeAs::nullableFloat($this->defaultTo),
            resolver: TypeAs::nullableClass(NullableFloatResolver::class, $this->resolveUsing)
        );
    }

    public function toInt(): ?int
    {
        return TypeAs::nullableInt(
            value: $this->fromValue,
            default: TypeAs::nullableInt($this->defaultTo),
            resolver: TypeAs::nullableClass(NullableIntResolver::class, $this->resolveUsing)
        );
    }

    public function toString(): ?string
    {
        return TypeAs::nullableString(
            value: $this->fromValue,
            default: TypeAs::nullableString($this->defaultTo),
            resolver: TypeAs::nullableClass(NullableStringResolver::class, $this->resolveUsing)
        );
    }
}
