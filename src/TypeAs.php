<?php

namespace Smpita\TypeAs;

use Smpita\TypeAs\Concerns\Instance\Base\ForwardsArrayStatics;
use Smpita\TypeAs\Concerns\Instance\Base\ForwardsBoolStatics;
use Smpita\TypeAs\Concerns\Instance\Base\ForwardsClassStatics;
use Smpita\TypeAs\Concerns\Instance\Base\ForwardsFloatStatics;
use Smpita\TypeAs\Concerns\Instance\Base\ForwardsIntStatics;
use Smpita\TypeAs\Concerns\Instance\Base\ForwardsStringStatics;
use Smpita\TypeAs\Concerns\Instance\Extensions\ForwardsFilterBoolStatics;
use Smpita\TypeAs\Concerns\Instance\HandlesTypeAsService;

/**
 * @see \Smpita\TypeAs\TypeAsService
 */
class TypeAs
{
    use ForwardsArrayStatics;
    use ForwardsBoolStatics;
    use ForwardsClassStatics;
    use ForwardsFilterBoolStatics;
    use ForwardsFloatStatics;
    use ForwardsIntStatics;
    use ForwardsStringStatics;
    use HandlesTypeAsService;
}
