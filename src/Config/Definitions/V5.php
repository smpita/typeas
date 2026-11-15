<?php

namespace Smpita\TypeAs\Config\Definitions;

use Smpita\TypeAs\Contracts\ResolverConfigDefinition;
use Smpita\TypeAs\Data\ResolverConfig;
use Smpita\TypeAs\Resolvers\V5\AsArray;
use Smpita\TypeAs\Resolvers\V5\AsBool;
use Smpita\TypeAs\Resolvers\V5\AsClass;
use Smpita\TypeAs\Resolvers\V5\AsFloat;
use Smpita\TypeAs\Resolvers\V5\AsInt;
use Smpita\TypeAs\Resolvers\V5\AsString;
use Smpita\TypeAs\Resolvers\V5\AsFilterBool;

class V5 implements ResolverConfigDefinition
{
    private static ResolverConfig $config;

    public static function config(): ResolverConfig
    {
        return self::$config ??= new ResolverConfig(
            arrayResolverClass: AsArray::class,
            boolResolverClass: AsBool::class,
            classResolverClass: AsClass::class,
            filterBoolResolverClass: AsFilterBool::class,
            floatResolverClass: AsFloat::class,
            intResolverClass: AsInt::class,
            stringResolverClass: AsString::class,
        );
    }
}
