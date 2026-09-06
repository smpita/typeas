<?php

namespace Smpita\TypeAs\Concerns\Resolvers\Object;

trait ResolvesMethods
{
    /**
     * @param string[] $methods
     */
    public function resolveMethods(object $value, array $methods): mixed
    {
        foreach ($methods as $method) {
            $resolved = $this->resolveMethod($value, $method);

            if (! is_null($resolved)) {
                return $resolved;
            }
        }

        return null;
    }

    public function resolveMethod(object $value, string $method): mixed
    {
        if (method_exists($value, $method) && is_callable([$value, $method])) {
            return $value->{$method}();
        }

        return null;
    }
}
