<?php

declare(strict_types=1);

namespace Smpita\TypeAs\Tests\Fixtures;

use Smpita\TypeAs\TypeAs;

class MixedToFloat
{
    public mixed $data = '0.0';

    public function main(): float
    {
        $typed = TypeAs::float($this->data);

        return $this->test($typed);
    }

    private function test(float $input): float
    {
        return $input;
    }
}
