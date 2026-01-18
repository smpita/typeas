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

    public static function new(?TypeConfig $config = null): self
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
        $this->config->fromValue = $value;

        return $this;
    }

    public function default(mixed $default): self
    {
        $this->config->defaultTo = $default;

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
        $this->config->resolveUsing = $resolver;

        return $this;
    }

    public function wrap(?bool $enabled = true): self
    {
        $this->config->arrayWrap = $enabled;

        return $this;
    }

    public function noWrap(): self
    {
        return $this->wrap(false);
    }

    public function import(TypeConfig $config): self
    {
        $this->config = $config;

        return $this;
    }

    public function nonNullable(): NonNullable
    {
        return NonNullable::new($this->config);
    }

    public function nullable(): Nullable
    {
        return Nullable::new($this->config);
    }
}
