<?php

namespace Smpita\TypeAs\Concerns\Resolvers\Base;

use Smpita\TypeAs\Contracts\BoolResolver;
use Smpita\TypeAs\Contracts\NullableBoolResolver;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\Resolvers\Base\AsBool;
use Smpita\TypeAs\Resolvers\Base\AsNullableBool;

trait ResolvesBools
{
    protected ?BoolResolver $boolResolver = null;

    protected ?NullableBoolResolver $nullableBoolResolver = null;

    /**
     * @throws TypeAsResolutionException
     */
    public function bool(mixed $value, ?bool $default = null, ?BoolResolver $resolver = null): bool
    {
        $resolver ??= $this->boolResolver ??= new AsBool;

        return $resolver->resolve($value, $default);
    }

    public function nullableBool(mixed $value, ?bool $default = null, ?NullableBoolResolver $resolver = null): ?bool
    {
        $resolver ??= $this->nullableBoolResolver ??= new AsNullableBool;

        return $resolver->resolve($value, $default);
    }

    public function setBoolResolver(?BoolResolver $resolver): void
    {
        $this->boolResolver = $resolver;
    }

    public function setNullableBoolResolver(?NullableBoolResolver $resolver): void
    {
        $this->nullableBoolResolver = $resolver;
    }
}
