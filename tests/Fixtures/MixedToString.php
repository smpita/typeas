<?php

declare(strict_types=1);

namespace Smpita\TypeAs\Tests\Fixtures;

use Smpita\TypeAs\TypeAs;

class MixedToString
{
    public mixed $data = 0;

    public function main(): string
    {
        $typed = TypeAs::string($this->data);

        return $this->test($typed);
    }

    private function test(string $input): string
    {
        return $input;
    }
}
