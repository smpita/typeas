<?php

declare(strict_types=1);

namespace Smpita\TypeAs\Tests\Fixtures;

use Smpita\TypeAs\TypeAs;

class MixedToArray
{
    public mixed $data = [];

    /**
     * @return array<mixed>
     */
    public function main(): array
    {
        $typed = TypeAs::array($this->data);

        return $this->test($typed);
    }

    /**
     * @param array<mixed> $input
     * @return array<mixed>
     */
    private function test(array $input): array
    {
        return $input;
    }
}
