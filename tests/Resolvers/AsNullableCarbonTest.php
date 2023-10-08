<?php

namespace Smpita\TypeAs\Tests\Resolvers;

use DateTime;
use Illuminate\Support\Carbon;
use Smpita\TypeAs\Tests\TestCase;
use Smpita\TypeAs\TypeAs;

class AsNullableCarbonTest extends TestCase
{
    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canCarbonifyStrings(): void
    {
        $this->assertInstanceOf(Carbon::class, TypeAs::nullableCarbon(now()->toDateString()));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canCarbonifyDateTimeObjects(): void
    {
        $this->assertInstanceOf(Carbon::class, TypeAs::nullableCarbon(new DateTime()));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function willReturnNullOnNonObjects(): void
    {
        $this->assertNull(TypeAs::nullableCarbon('not-valid'));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function willNotThrowExceptionWithDefaults(): void
    {
        $this->assertInstanceOf(Carbon::class, TypeAs::nullableCarbon('not-valid', null, now()));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canPassStaticAnalysis(): void
    {
        $test = fn (?Carbon $value) => $value;

        $this->assertInstanceOf(Carbon::class, $test(TypeAs::nullableCarbon('now')));
    }
}
