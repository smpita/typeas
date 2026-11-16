<?php

namespace Smpita\TypeAs\Fluent;

use Smpita\TypeAs\Concerns\Fluent\HandlesFluentCalls;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\TypeAs;

class NonNullable
{
    use HandlesFluentCalls;

    public static function make(?TypeConfig $config = null): NonNullable
    {
        $config ??= new TypeConfig();

        return (new NonNullable())->import($config);
    }

    /**
     * @throws TypeAsResolutionException
     */
    public function asArray(): array
    {
        return TypeAs::onError(
            message: $this->config()->throwMessage,
            exception: $this->config()->throwException,
        )->array(
            value: $this->config()->fromValue,
            default: TypeAs::nullableArray($this->config()->defaultTo, wrap: false),
            resolver: $this->config()->resolvers()->arrayResolver(),
            wrap: $this->config()->arrayWrap,
        );
    }

    /**
     * @throws TypeAsResolutionException
     */
    public function asBool(): bool
    {
        return TypeAs::onError(
            message: $this->config()->throwMessage,
            exception: $this->config()->throwException,
        )->bool(
            value: $this->config()->fromValue,
            default: TypeAs::nullableBool($this->config()->defaultTo),
            resolver: $this->config()->resolvers()->boolResolver(),
        );
    }

    /**
     * @throws TypeAsResolutionException
     */
    public function asFilterBool(): bool
    {
        return TypeAs::onError(
            message: $this->config()->throwMessage,
            exception: $this->config()->throwException,
        )->filterBool(
            value: $this->config()->fromValue,
            default: TypeAs::nullableFilterBool($this->config()->defaultTo),
            resolver: $this->config()->resolvers()->filterBoolResolver()
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
    public function asClass(string $class)
    {
        return TypeAs::onError(
            message: $this->config()->throwMessage,
            exception: $this->config()->throwException,
        )->class(
            class: $class,
            value: $this->config()->fromValue,
            default: TypeAs::nullableClass(class: $class, value: $this->config()->defaultTo),
            resolver: $this->config()->resolvers()->classResolver(),
        );
    }

    /**
     * @throws TypeAsResolutionException
     */
    public function asFloat(): float
    {
        return TypeAs::onError(
            message: $this->config()->throwMessage,
            exception: $this->config()->throwException,
        )->float(
            value: $this->config()->fromValue,
            default: TypeAs::nullableFloat($this->config()->defaultTo),
            resolver: $this->config()->resolvers()->floatResolver(),
        );
    }

    /**
     * @throws TypeAsResolutionException
     */
    public function asInt(): int
    {
        return TypeAs::onError(
            message: $this->config()->throwMessage,
            exception: $this->config()->throwException,
        )->int(
            value: $this->config()->fromValue,
            default: TypeAs::nullableInt($this->config()->defaultTo),
            resolver: $this->config()->resolvers()->intResolver(),
        );
    }

    /**
     * @throws TypeAsResolutionException
     */
    public function asString(): string
    {
        return TypeAs::onError(
            message: $this->config()->throwMessage,
            exception: $this->config()->throwException,
        )->string(
            value: $this->config()->fromValue,
            default: TypeAs::nullableString($this->config()->defaultTo),
            resolver: $this->config()->resolvers()->stringResolver(),
        );
    }
}
