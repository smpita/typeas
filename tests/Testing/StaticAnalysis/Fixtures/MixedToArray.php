<?php

declare(strict_types=1);

namespace Smpita\TypeAs\Tests\Testing\StaticAnalysis\Fixtures;

class MixedToArray
{
    public mixed $data = [];

    /**
     * @return array<mixed>
     */
    public function static(): array
    {
        $typed = \Smpita\TypeAs\TypeAs::array($this->data);

        return $this->test($typed);
    }

    /**
     * @return array<mixed>
     */
    public function globalHelper(): array
    {
        $typed = \asArray($this->data);

        return $this->test($typed);
    }

    /**
     * @return array<mixed>
     */
    public function helper(): array
    {
        $typed = \Smpita\TypeAs\asArray($this->data);

        return $this->test($typed);
    }

    /**
     * @return array<mixed>
     */
    public function fluent(): array
    {
        $typed = \type($this->data)->asArray();

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
