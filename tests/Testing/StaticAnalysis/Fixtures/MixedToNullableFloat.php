<?php

declare(strict_types=1);

namespace Smpita\TypeAs\Tests\Testing\StaticAnalysis\Fixtures;

class MixedToNullableFloat
{
    public mixed $data = null;

    /**
     * @return float|null
     */
    public function static(): ?float
    {
        $typed = \Smpita\TypeAs\TypeAs::nullableFloat($this->data);

        return $this->test($typed);
    }

    /**
     * @return float|null
     */
    public function globalHelper(): ?float
    {
        $typed = \asNullableFloat($this->data);

        return $this->test($typed);
    }

    /**
     * @return float|null
     */
    public function helper(): ?float
    {
        $typed = \Smpita\TypeAs\asNullableFloat($this->data);

        return $this->test($typed);
    }

    /**
     * @return float|null
     */
    public function fluent(): ?float
    {
        $typed = \type($this->data)->nullable()->asFloat();

        return $this->test($typed);
    }

    /**
     * @param float|null $input
     * @return float|null
     */
    private function test(?float $input): ?float
    {
        return $input;
    }
}
