<?php

namespace Smpita\TypeAs\Data;

use Smpita\TypeAs\Config\ResolverVersion;
use Smpita\TypeAs\Contracts\ArrayResolver;
use Smpita\TypeAs\Contracts\BoolResolver;
use Smpita\TypeAs\Contracts\ClassResolver;
use Smpita\TypeAs\Contracts\FilterBoolResolver;
use Smpita\TypeAs\Contracts\FloatResolver;
use Smpita\TypeAs\Contracts\IntResolver;
use Smpita\TypeAs\Contracts\StringResolver;

final class ResolverRepository
{
    public ?ArrayResolver $arrayResolver = null;
    public ?BoolResolver $boolResolver = null;
    public ?ClassResolver $classResolver = null;
    public ?FilterBoolResolver $filterBoolResolver = null;
    public ?FloatResolver $floatResolver = null;
    public ?IntResolver $intResolver = null;
    public ?StringResolver $stringResolver = null;

    public function arrayResolver(): ArrayResolver
    {
        return $this->arrayResolver ??= ResolverVersion::default()->config()->arrayResolver();
    }

    public function boolResolver(): BoolResolver
    {
        return $this->boolResolver ??= ResolverVersion::default()->config()->boolResolver();
    }

    public function classResolver(): ClassResolver
    {
        return $this->classResolver ??= ResolverVersion::default()->config()->classResolver();
    }

    public function filterBoolResolver(): FilterBoolResolver
    {
        return $this->filterBoolResolver ??= ResolverVersion::default()->config()->filterBoolResolver();
    }

    public function floatResolver(): FloatResolver
    {
        return $this->floatResolver ??= ResolverVersion::default()->config()->floatResolver();
    }

    public function intResolver(): IntResolver
    {
        return $this->intResolver ??= ResolverVersion::default()->config()->intResolver();
    }

    public function stringResolver(): StringResolver
    {
        return $this->stringResolver ??= ResolverVersion::default()->config()->stringResolver();
    }

    public function setArrayResolver(?ArrayResolver $resolver): void
    {
        $this->arrayResolver = $resolver;
    }

    public function setBoolResolver(?BoolResolver $resolver): void
    {
        $this->boolResolver = $resolver;
    }

    public function setClassResolver(?ClassResolver $resolver): void
    {
        $this->classResolver = $resolver;
    }

    public function setFilterBoolResolver(?FilterBoolResolver $resolver): void
    {
        $this->filterBoolResolver = $resolver;
    }

    public function setFloatResolver(?FloatResolver $resolver): void
    {
        $this->floatResolver = $resolver;
    }

    public function setIntResolver(?IntResolver $resolver): void
    {
        $this->intResolver = $resolver;
    }

    public function setStringResolver(?StringResolver $resolver): void
    {
        $this->stringResolver = $resolver;
    }
}
