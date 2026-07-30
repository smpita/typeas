<?php

declare(strict_types=1);

namespace Smpita\TypeAs\Tests\Fixtures;

use Smpita\TypeAs\TypeAs;

class MixedToInt
{
    public mixed $data = '0';

    public function main(): int
    {
        $typed = TypeAs::int($this->data);

        return $this->test($typed);
    }

    private function test(int $input): int
    {
        return $input;
    }
}
