<?php

namespace Smpita\TypeAs;

use Smpita\TypeAs\Concerns\Resolvers\Base\ResolvesInts;
use Smpita\TypeAs\Concerns\Resolvers\Base\ResolvesBools;
use Smpita\TypeAs\Concerns\Resolvers\Base\ResolvesArrays;
use Smpita\TypeAs\Concerns\Resolvers\Base\ResolvesFloats;
use Smpita\TypeAs\Concerns\Resolvers\Base\ResolvesClasses;
use Smpita\TypeAs\Concerns\Resolvers\Base\ResolvesStrings;
use Smpita\TypeAs\Concerns\Resolvers\Extensions\ResolvesFilterBools;

class TypeAs
{
    use ResolvesArrays;
    use ResolvesBools;
    use ResolvesClasses;
    use ResolvesFloats;
    use ResolvesInts;
    use ResolvesStrings;

    public static function useDefaultResolvers(): void
    {
        self::setNullableArrayResolver(null);
        self::setNullableBoolResolver(null);
        self::setNullableClassResolver(null);
        self::setNullableFloatResolver(null);
        self::setNullableIntResolver(null);
        self::setNullableStringResolver(null);
        self::setArrayResolver(null);
        self::setBoolResolver(null);
        self::setClassResolver(null);
        self::setFloatResolver(null);
        self::setIntResolver(null);
        self::setStringResolver(null);
    }
}
