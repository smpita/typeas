<?php

declare(strict_types=1);

namespace Smpita\TypeAs\Tests\Testing\StaticAnalysis\Fixtures;

class MixedToBool
{
    public mixed $data = false;

    /**
     * @return bool
     */
    public function static(): bool
    {
        $typed = \Smpita\TypeAs\TypeAs::bool($this->data);

        return $this->test($typed);
    }

    /**
     * @return bool
     */
    public function globalHelper(): bool
    {
        $typed = \asBool($this->data);

        return $this->test($typed);
    }

    /**
     * @return bool
     */
    public function helper(): bool
    {
        $typed = \Smpita\TypeAs\asBool($this->data);

        return $this->test($typed);
    }

    /**
     * @return bool
     */
    public function fluent(): bool
    {
        $typed = \type($this->data)->asBool();

        return $this->test($typed);
    }

    /**
     * @param bool $input
     * @return bool
     */
    private function test(bool $input): bool
    {
        return $input;
    }
}
