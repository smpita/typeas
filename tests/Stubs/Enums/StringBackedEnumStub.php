<?php

namespace Smpita\TypeAs\Tests\Stubs\Enums;

enum StringBackedEnumStub: string
{
    case Zero = '0';
    case One = '1';
    case OnePointFive = '1.5';
    case Two = '2';
    case True = 'true';
    case False = 'false';
    case Null = 'null';
    case Yes = 'yes';
    case On = 'on';
    case No = 'no';
    case Off = 'off';
    case Empty = '';
}
