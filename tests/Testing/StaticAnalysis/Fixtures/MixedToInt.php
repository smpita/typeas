<?php

declare(strict_types=1);

namespace Smpita\TypeAs\Tests\Testing\StaticAnalysis\Fixtures;

class MixedToInt
{
    public mixed $data = '0';

    /**
     * @return int
     */
    public function static(): int
    {
        $typed = \Smpita\TypeAs\TypeAs::int($this->data);

        return $this->test($typed);
    }

    /**
     * @return int
     */
    public function globalHelper(): int
    {
        $typed = \asInt($this->data);

        return $this->test($typed);
    }

    /**
     * @return int
     */
    public function helper(): int
    {
        $typed = \Smpita\TypeAs\asInt($this->data);

        return $this->test($typed);
    }

    /**
     * @return int
     */
    public function fluent(): int
    {
        $typed = \type($this->data)->asInt();

        return $this->test($typed);
    }

    /**
     * @param int $input
     * @return int
     */
    private function test(int $input): int
    {
        return $input;
    }
}
