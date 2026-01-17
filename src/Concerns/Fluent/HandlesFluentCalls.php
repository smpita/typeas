<?php

namespace Smpita\TypeAs\Concerns\Fluent;

use Smpita\TypeAs\Contracts\ArrayResolver;
use Smpita\TypeAs\Contracts\BoolResolver;
use Smpita\TypeAs\Contracts\ClassResolver;
use Smpita\TypeAs\Contracts\FloatResolver;
use Smpita\TypeAs\Contracts\IntResolver;
use Smpita\TypeAs\Contracts\NullableArrayResolver;
use Smpita\TypeAs\Contracts\NullableBoolResolver;
use Smpita\TypeAs\Contracts\NullableClassResolver;
use Smpita\TypeAs\Contracts\NullableFloatResolver;
use Smpita\TypeAs\Contracts\NullableIntResolver;
use Smpita\TypeAs\Contracts\NullableStringResolver;
use Smpita\TypeAs\Contracts\StringResolver;
use Smpita\TypeAs\Fluent\Nullable;
use Smpita\TypeAs\Fluent\Strict;

trait HandlesFluentCalls
{
    protected mixed $fromValue = null;

    protected mixed $defaultTo = null;

    protected ArrayResolver|NullableArrayResolver
        |BoolResolver|NullableBoolResolver
        |ClassResolver|NullableClassResolver
        |FloatResolver|NullableFloatResolver
        |IntResolver|NullableIntResolver
        |StringResolver|NullableStringResolver
        |null $resolveUsing = null;

    protected ?bool $arrayWrap = null;

    public static function new(): self
    {
        return new self();
    }

    public function from(mixed $value): self
    {
        $this->fromValue = $value;

        return $this;
    }

    public function default(mixed $default): self
    {
        $this->defaultTo = $default;

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
        $this->resolveUsing = $resolver;

        return $this;
    }

    public function wrap(?bool $enabled = true): self
    {
        $this->arrayWrap = $enabled;

        return $this;
    }

    public function noWrap(): self
    {
        return $this->wrap(false);
    }

    public function strict(): Strict
    {
        return (new Strict())
            ->from($this->fromValue)
            ->default($this->defaultTo)
            ->using($this->resolveUsing)
            ->wrap($this->arrayWrap);
    }

    public function nullable(): Nullable
    {
        return (new Nullable())
            ->from($this->fromValue)
            ->default($this->defaultTo)
            ->using($this->resolveUsing)
            ->wrap($this->arrayWrap);
    }
}
