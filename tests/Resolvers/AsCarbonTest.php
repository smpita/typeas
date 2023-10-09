<?php

namespace Smpita\TypeAs\Tests\Resolvers;

use DateTime;
use Exception;
use Illuminate\Support\Carbon;
use Smpita\TypeAs\Tests\TestCase;
use Smpita\TypeAs\TypeAs;

class AsCarbonTest extends TestCase
{
    /**
     * @test
     *
     * @legacy
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
     * @legacy
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
     * @legacy
     *
     * @group smpita
     * @group typeas
     */
    public function willThrowExceptionOnNonObjects(): void
    {
        $this->expectException(Exception::class);

        TypeAs::carbon('not-valid');
    }

    /**
     * @test
     *
     * @legacy
     *
     * @group smpita
     * @group typeas
     */
    public function willNotThrowExceptionWithDefaults(): void
    {
        $this->assertInstanceOf(Carbon::class, TypeAs::carbon('not-valid', null, now()));
    }

    /**
     * @test
     *
     * @legacy
     *
     * @group smpita
     * @group typeas
     */
    public function canPassStaticAnalysis(): void
    {
        $test = fn (Carbon $value) => $value;

        $this->assertInstanceOf(Carbon::class, $test(TypeAs::carbon('now')));
    }
}
