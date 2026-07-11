<?php

namespace Smpita\TypeAs\Fluent;

use Smpita\TypeAs\Contracts\ArrayResolver;
use Smpita\TypeAs\Contracts\BoolResolver;
use Smpita\TypeAs\Contracts\ClassResolver;
use Smpita\TypeAs\Contracts\FloatResolver;
use Smpita\TypeAs\Contracts\IntResolver;
use Smpita\TypeAs\Contracts\StringResolver;

final class TypeConfig
{
    public function __construct(
        public mixed $fromValue = null,
        public mixed $defaultTo = null,
        public ?ArrayResolver $arrayResolver = null,
        public ?BoolResolver $boolResolver = null,
        public ?ClassResolver $classResolver = null,
        public ?FloatResolver $floatResolver = null,
        public ?IntResolver $intResolver = null,
        public ?StringResolver $stringResolver = null,
        public ?bool $arrayWrap = true,
    ) {
    }

    public function resetResolvers(): void
    {
        $this->arrayResolver = null;
        $this->boolResolver = null;
        $this->classResolver = null;
        $this->floatResolver = null;
        $this->intResolver = null;
        $this->stringResolver = null;
    }
}
