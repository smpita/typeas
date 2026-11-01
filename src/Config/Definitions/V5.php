<?php

namespace Smpita\TypeAs\Config\Definitions;

use Smpita\TypeAs\Contracts\ResolverConfigDefinition;
use Smpita\TypeAs\Data\ResolverConfig;
use Smpita\TypeAs\Resolvers\Base\AsArray;
use Smpita\TypeAs\Resolvers\Base\AsBool;
use Smpita\TypeAs\Resolvers\Base\AsClass;
use Smpita\TypeAs\Resolvers\Base\AsFloat;
use Smpita\TypeAs\Resolvers\Base\AsInt;
use Smpita\TypeAs\Resolvers\Base\AsString;
use Smpita\TypeAs\Resolvers\Base\AsFilterBool;

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
