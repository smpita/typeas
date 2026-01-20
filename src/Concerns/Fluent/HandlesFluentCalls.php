<?php

namespace Smpita\TypeAs\Concerns\Fluent;

use Smpita\TypeAs\Fluent\Nullable;
use Smpita\TypeAs\Fluent\TypeConfig;
use Smpita\TypeAs\Fluent\NonNullable;
use Smpita\TypeAs\Contracts\IntResolver;
use Smpita\TypeAs\Contracts\BoolResolver;
use Smpita\TypeAs\Contracts\ArrayResolver;
use Smpita\TypeAs\Contracts\ClassResolver;
use Smpita\TypeAs\Contracts\FloatResolver;
use Smpita\TypeAs\Contracts\StringResolver;
use Smpita\TypeAs\Contracts\NullableIntResolver;
use Smpita\TypeAs\Contracts\NullableBoolResolver;
use Smpita\TypeAs\Contracts\NullableArrayResolver;
use Smpita\TypeAs\Contracts\NullableClassResolver;
use Smpita\TypeAs\Contracts\NullableFloatResolver;
use Smpita\TypeAs\Contracts\NullableStringResolver;

trait HandlesFluentCalls
{
    protected TypeConfig $config;

    public function __clone(): void
    {
        $this->config = clone $this->config;
    }

    public static function make(?TypeConfig $config = null): self
    {
        $config ??= new TypeConfig();

        return (new self())->import($config);
    }

    public function copy(): self
    {
        return clone $this;
    }

    public function from(mixed $value): self
    {
        $this->config()->fromValue = $value;

        return $this;
    }

    public function default(mixed $default): self
    {
        $this->config()->defaultTo = $default;

        return $this;
    }

    public function using(
        ArrayResolver|NullableArrayResolver
        |BoolResolver|NullableBoolResolver
        |ClassResolver|NullableClassResolver
        |FloatResolver|NullableFloatResolver
        |IntResolver|NullableIntResolver
        |StringResolver|NullableStringResolver
        |null $resolver
    ): self {
        match(true) {
            is_null($resolver) => $this->useDefaultResolvers(),
            $resolver instanceof ArrayResolver
                => $this->config()->arrayResolver = $resolver,
            $resolver instanceof NullableArrayResolver
                => $this->config()->nullableArrayResolver = $resolver,
            $resolver instanceof BoolResolver
                => $this->config()->boolResolver = $resolver,
            $resolver instanceof NullableBoolResolver
                => $this->config()->nullableBoolResolver = $resolver,
            $resolver instanceof ClassResolver
                => $this->config()->classResolver = $resolver,
            $resolver instanceof NullableClassResolver
                => $this->config()->nullableClassResolver = $resolver,
            $resolver instanceof FloatResolver
                => $this->config()->floatResolver = $resolver,
            $resolver instanceof NullableFloatResolver
                => $this->config()->nullableFloatResolver = $resolver,
            $resolver instanceof IntResolver
                => $this->config()->intResolver = $resolver,
            $resolver instanceof NullableIntResolver
                => $this->config()->nullableIntResolver = $resolver,
            $resolver instanceof StringResolver
                => $this->config()->stringResolver = $resolver,
            $resolver instanceof NullableStringResolver
                => $this->config()->nullableStringResolver = $resolver,
        };

        return $this;
    }

    public function wrap(?bool $enabled = true): self
    {
        $this->config()->arrayWrap = $enabled;

        return $this;
    }

    public function noWrap(): self
    {
        return $this->wrap(false);
    }

    public function config(): TypeConfig
    {
        return $this->config ??= new TypeConfig();
    }

    public function import(TypeConfig $config): self
    {
        $this->config = $config;

        return $this;
    }

    public function nonNullable(): NonNullable
    {
        return NonNullable::make($this->config);
    }

    public function nullable(): Nullable
    {
        return Nullable::make($this->config);
    }

    protected function useDefaultResolvers(): void
    {
        $this->config()->nullableArrayResolver = null;
        $this->config()->nullableBoolResolver = null;
        $this->config()->nullableClassResolver = null;
        $this->config()->nullableFloatResolver = null;
        $this->config()->nullableIntResolver = null;
        $this->config()->nullableStringResolver = null;
        $this->config()->arrayResolver = null;
        $this->config()->boolResolver = null;
        $this->config()->classResolver = null;
        $this->config()->floatResolver = null;
        $this->config()->intResolver = null;
        $this->config()->stringResolver = null;
    }
}
