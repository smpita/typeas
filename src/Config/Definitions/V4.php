<?php

namespace Smpita\TypeAs\Config\Definitions;

use Smpita\TypeAs\Contracts\ResolverConfigDefinition;
use Smpita\TypeAs\Data\ResolverConfig;
use Smpita\TypeAs\Resolvers\V4\AsArray;
use Smpita\TypeAs\Resolvers\V4\AsBool;
use Smpita\TypeAs\Resolvers\V4\AsClass;
use Smpita\TypeAs\Resolvers\V4\AsFloat;
use Smpita\TypeAs\Resolvers\V4\AsInt;
use Smpita\TypeAs\Resolvers\V4\AsString;
use Smpita\TypeAs\Resolvers\V4\AsFilterBool;

class V4 implements ResolverConfigDefinition
{
    private static ResolverConfig $config;

    public static function config(): ResolverConfig
    {
        return self::$config ??= new ResolverConfig(
            arrayResolverClass: AsArray::class,
            boolResolverClass: AsBool::class,
            filterBoolResolverClass: AsFilterBool::class,
            classResolverClass: AsClass::class,
            floatResolverClass: AsFloat::class,
            intResolverClass: AsInt::class,
            stringResolverClass: AsString::class,
        );
    }
}
