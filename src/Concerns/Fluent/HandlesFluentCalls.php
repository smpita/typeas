<?php

namespace Smpita\TypeAs\Concerns\Fluent;

use Smpita\TypeAs\Contracts\ArrayResolver;
use Smpita\TypeAs\Contracts\BoolResolver;
use Smpita\TypeAs\Contracts\ClassResolver;
use Smpita\TypeAs\Contracts\FloatResolver;
use Smpita\TypeAs\Contracts\IntResolver;
use Smpita\TypeAs\Contracts\StringResolver;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\Fluent\NonNullable;
use Smpita\TypeAs\Fluent\Nullable;
use Smpita\TypeAs\Fluent\TypeConfig;

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

    public function type(mixed $value): self
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
        ArrayResolver
        |BoolResolver
        |ClassResolver
        |FloatResolver
        |IntResolver
        |StringResolver
        |null $resolver
    ): self {
        match(true) {
            is_null($resolver) => $this->config()->resetResolvers(),
            $resolver instanceof ArrayResolver
                => $this->config()->arrayResolver = $resolver,
            $resolver instanceof BoolResolver
                => $this->config()->boolResolver = $resolver,
            $resolver instanceof ClassResolver
                => $this->config()->classResolver = $resolver,
            $resolver instanceof FloatResolver
                => $this->config()->floatResolver = $resolver,
            $resolver instanceof IntResolver
                => $this->config()->intResolver = $resolver,
            $resolver instanceof StringResolver
                => $this->config()->stringResolver = $resolver,
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

    /**
     * @param class-string<TypeAsResolutionException>|null $exception
     */
    public function onError(?string $message = null, ?string $exception = null): self
    {
        $this->config()->throwMessage = $message;
        $this->config()->throwException = $exception;

        return $this;
    }
}
