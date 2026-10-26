<?php

namespace Smpita\TypeAs\Fluent;

use Smpita\TypeAs\Concerns\Resolvers\HandlesResolverRegistration;
use Smpita\TypeAs\Data\ResolverRepository;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\TypeAs;

final class TypeConfig
{
    use HandlesResolverRegistration;

    /**
     * @param class-string<TypeAsResolutionException>|null $throwException
     */
    public function __construct(
        ?ResolverRepository $resolvers = null,
        public mixed $fromValue = null,
        public mixed $defaultTo = null,
        public ?bool $arrayWrap = true,
        public ?string $throwException = null,
        public ?string $throwMessage = null,
    ) {
        $this->resolvers ??= $resolvers ??= TypeAs::getInstance()->resolvers();
    }
}
