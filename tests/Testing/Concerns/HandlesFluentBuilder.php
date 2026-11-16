<?php

namespace Smpita\TypeAs\Tests\Testing\Concerns;

use Smpita\TypeAs\Fluent\NonNullable;
use Smpita\TypeAs\Fluent\Nullable;

trait HandlesFluentBuilder
{
    protected function builder(mixed $value, bool $nullable = false, array $options = []): NonNullable|Nullable
    {
        $builder = type($value);

        if ($nullable) {
            $builder = $builder->nullable();
        }

        $options['wrap'] ?? true
            ? $builder->wrap()
            : $builder->noWrap();

        if (isset($options['default'])) {
            $builder->default($options['default']);
        }

        return $builder;
    }
}
