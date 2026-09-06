<?php

namespace Smpita\TypeAs\Data;

use Smpita\TypeAs\Contracts\ArrayResolver;
use Smpita\TypeAs\Contracts\BoolResolver;
use Smpita\TypeAs\Contracts\ClassResolver;
use Smpita\TypeAs\Contracts\FloatResolver;
use Smpita\TypeAs\Contracts\IntResolver;
use Smpita\TypeAs\Contracts\StringResolver;

final class ResolverConfig
{
    public function __construct(
        /** @var class-string<ArrayResolver> */
        public string $arrayResolverClass,
        /** @var class-string<BoolResolver> */
        public string $boolResolverClass,
        /** @var class-string<ClassResolver> */
        public string $classResolverClass,
        /** @var class-string<FloatResolver> */
        public string $floatResolverClass,
        /** @var class-string<IntResolver> */
        public string $intResolverClass,
        /** @var class-string<StringResolver> */
        public string $stringResolverClass,
        /** @var class-string<BoolResolver> */
        public string $filterBoolResolverClass,
    ) {
    }

    public function arrayResolver(): ArrayResolver
    {
        return new $this->arrayResolverClass();
    }

    public function boolResolver(): BoolResolver
    {
        return new $this->boolResolverClass();
    }

    public function classResolver(): ClassResolver
    {
        return new $this->classResolverClass();
    }

    public function floatResolver(): FloatResolver
    {
        return new $this->floatResolverClass();
    }

    public function intResolver(): IntResolver
    {
        return new $this->intResolverClass();
    }

    public function stringResolver(): StringResolver
    {
        return new $this->stringResolverClass();
    }

    public function filterBoolResolver(): BoolResolver
    {
        return new $this->filterBoolResolverClass();
    }
}
