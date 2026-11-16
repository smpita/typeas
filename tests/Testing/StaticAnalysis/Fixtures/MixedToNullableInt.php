<?php

declare(strict_types=1);

namespace Smpita\TypeAs\Tests\Testing\StaticAnalysis\Fixtures;

class MixedToNullableInt
{
    public mixed $data = null;

    /**
     * @return int|null
     */
    public function static(): ?int
    {
        $typed = \Smpita\TypeAs\TypeAs::nullableInt($this->data);

        return $this->test($typed);
    }

    /**
     * @return int|null
     */
    public function globalHelper(): ?int
    {
        $typed = \asNullableInt($this->data);

        return $this->test($typed);
    }

    /**
     * @return int|null
     */
    public function helper(): ?int
    {
        $typed = \Smpita\TypeAs\asNullableInt($this->data);

        return $this->test($typed);
    }

    /**
     * @return int|null
     */
    public function fluent(): ?int
    {
        $typed = \type($this->data)->nullable()->asInt();

        return $this->test($typed);
    }

    /**
     * @param int|null $input
     * @return int|null
     */
    private function test(?int $input): ?int
    {
        return $input;
    }
}
