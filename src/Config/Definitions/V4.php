<?php

namespace Smpita\TypeAs\Config\Definitions;

use Smpita\TypeAs\Data\ResolverConfig;
use Smpita\TypeAs\Resolvers\Legacy\V4\Base\AsArray;
use Smpita\TypeAs\Resolvers\Legacy\V4\Base\AsBool;
use Smpita\TypeAs\Resolvers\Legacy\V4\Base\AsClass;
use Smpita\TypeAs\Resolvers\Legacy\V4\Base\AsFloat;
use Smpita\TypeAs\Resolvers\Legacy\V4\Base\AsInt;
use Smpita\TypeAs\Resolvers\Legacy\V4\Base\AsString;
use Smpita\TypeAs\Resolvers\Legacy\V4\Extensions\AsFilterBool;

class V4
{
    private static ResolverConfig $config;

    public static function config(): ResolverConfig
    {
        return self::$config ??= new ResolverConfig(
            arrayResolverClass: AsArray::class,
            boolResolverClass: AsBool::class,
            classResolverClass: AsClass::class,
            floatResolverClass: AsFloat::class,
            intResolverClass: AsInt::class,
            stringResolverClass: AsString::class,
            filterBoolResolverClass: AsFilterBool::class,
        );
    }
}
