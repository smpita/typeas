<?php

declare(strict_types=1);

namespace Smpita\TypeAs\Tests\Fixtures;

use Smpita\TypeAs\TypeAs;

class MixedToArray
{
    public mixed $data = false;

    public function main(): bool
    {
        $typed = TypeAs::bool($this->data);

        return $this->test($typed);
    }

    private function test(bool $input): bool
    {
        return $input;
    }
}
