<?php

namespace Smpita\TypeAs\Concerns\Instance;

use Smpita\TypeAs\TypeAsService;

trait HandlesTypeAsService
{
    protected static TypeAsService $instance;

    public static function useDefaultResolvers(): void
    {
        static::getInstance()->useDefaultResolvers();
    }

    public static function getInstance(): TypeAsService
    {
        return static::$instance ??= new TypeAsService;
    }
}
