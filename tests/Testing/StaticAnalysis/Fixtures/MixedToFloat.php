<?php

declare(strict_types=1);

namespace Smpita\TypeAs\Tests\Testing\StaticAnalysis\Fixtures;

class MixedToFloat
{
    public mixed $data = '0.0';

    /**
     * @return float
     */
    public function static(): float
    {
        $typed = \Smpita\TypeAs\TypeAs::float($this->data);

        return $this->test($typed);
    }

    /**
     * @return float
     */
    public function globalHelper(): float
    {
        $typed = \asFloat($this->data);

        return $this->test($typed);
    }

    /**
     * @return float
     */
    public function helper(): float
    {
        $typed = \Smpita\TypeAs\asFloat($this->data);

        return $this->test($typed);
    }

    /**
     * @return float
     */
    public function fluent(): float
    {
        $typed = \type($this->data)->asFloat();

        return $this->test($typed);
    }

    /**
     * @param float $input
     * @return float
     */
    private function test(float $input): float
    {
        return $input;
    }
}
