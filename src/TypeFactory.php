<?php

namespace Smpita\TypeAs;

use Smpita\TypeAs\Concerns\Resolvers\Base\ResolvesArrays;
use Smpita\TypeAs\Concerns\Resolvers\Base\ResolvesBools;
use Smpita\TypeAs\Concerns\Resolvers\Base\ResolvesClasses;
use Smpita\TypeAs\Concerns\Resolvers\Base\ResolvesFloats;
use Smpita\TypeAs\Concerns\Resolvers\Base\ResolvesInts;
use Smpita\TypeAs\Concerns\Resolvers\Base\ResolvesStrings;
use Smpita\TypeAs\Concerns\Resolvers\Base\ResolvesFilterBools;

class TypeFactory
{
    use ResolvesArrays;
    use ResolvesBools;
    use ResolvesClasses;
    use ResolvesFilterBools;
    use ResolvesFloats;
    use ResolvesInts;
    use ResolvesStrings;
}
