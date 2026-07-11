<?php

namespace Smpita\TypeAs\Concerns\Resolvers\Base;

use Smpita\TypeAs\Contracts\BoolResolver;
use Smpita\TypeAs\Concerns\ThrowsTypeAsResolutionExceptions;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\Resolvers\Base\AsBool;
use Smpita\TypeAs\Resolvers\Base\AsNullableBool;

trait ResolvesBools
{
    use ThrowsTypeAsResolutionExceptions;

    protected ?BoolResolver $boolResolver = null;

    /**
     * @throws TypeAsResolutionException
     */
    public function bool(mixed $value, ?bool $default = null, ?BoolResolver $resolver = null): bool
    {
        $resolver ??= $this->boolResolver ??= new AsBool();

        return $resolver->resolve(value: $value, default: $default) ?? static::throwResolutionException($value);
    }

    public function nullableBool(mixed $value, ?bool $default = null, ?BoolResolver $resolver = null): ?bool
    {
        $resolver ??= $this->boolResolver ??= new AsNullableBool();

        return $resolver->resolve(value: $value, default: $default);
    }

    public function setBoolResolver(?BoolResolver $resolver): void
    {
        $this->boolResolver = $resolver;
    }
}
