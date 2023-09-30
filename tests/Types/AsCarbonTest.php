<?php

namespace Smpita\TypeAs\Tests\Types;

use Carbon\Exceptions\InvalidFormatException;
use DateTime;
use Illuminate\Support\Carbon;
use Smpita\TypeAs\Tests\TestCase;
use Smpita\TypeAs\TypeAs;

class AsCarbonTest extends TestCase
{
    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canCarbonifyStrings(): void
    {
        $this->assertInstanceOf(Carbon::class, TypeAs::carbon(now()->toDateString()));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canCarbonifyDateTimeObjects(): void
    {
        $this->assertInstanceOf(Carbon::class, TypeAs::carbon(new DateTime()));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function willThrowExceptionOnNonObjects(): void
    {
        $this->expectException(InvalidFormatException::class);

        TypeAs::carbon('not-valid');
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function willNotThrowExceptionWithDefaults(): void
    {
        $this->assertInstanceOf(Carbon::class, TypeAs::carbon('not-valid', null, now()));
    }
}
