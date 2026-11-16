<?php

declare(strict_types=1);

namespace Smpita\TypeAs\Tests\Testing\StaticAnalysis\Fixtures;

class MixedToNullableBool
{
    public mixed $data = null;

    /**
     * @return bool|null
     */
    public function static(): ?bool
    {
        $typed = \Smpita\TypeAs\TypeAs::nullableBool($this->data);

        return $this->test($typed);
    }

    /**
     * @return bool|null
     */
    public function globalHelper(): ?bool
    {
        $typed = \asNullableBool($this->data);

        return $this->test($typed);
    }

    /**
     * @return bool|null
     */
    public function helper(): ?bool
    {
        $typed = \Smpita\TypeAs\asNullableBool($this->data);

        return $this->test($typed);
    }

    /**
     * @return bool|null
     */
    public function fluent(): ?bool
    {
        $typed = \type($this->data)->nullable()->asBool();

        return $this->test($typed);
    }

    /**
     * @param bool|null $input
     * @return bool|null
     */
    private function test(?bool $input): ?bool
    {
        return $input;
    }
}
