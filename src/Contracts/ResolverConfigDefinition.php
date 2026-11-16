<?php

namespace Smpita\TypeAs\Contracts;

use Smpita\TypeAs\Data\ResolverConfig;

interface ResolverConfigDefinition
{
    public static function config(): ResolverConfig;
}
