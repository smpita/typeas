<?php

namespace Smpita\TypeAs\Concerns\Resolvers;

use Smpita\TypeAs\Data\ResolverRepository;

trait HandlesResolverRegistration
{
    public ?ResolverRepository $resolvers;

    public function resolvers(): ResolverRepository
    {
        return $this->resolvers ??= new ResolverRepository();
    }

    public function useDefaultResolvers(): void
    {
        $this->resolvers = new ResolverRepository();
    }
}
