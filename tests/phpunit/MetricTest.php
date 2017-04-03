<?php

namespace SamKnows\BackendTest;

use PHPUnit_Framework_TestCase;

class MetricTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function hoursCanBeCompared()
    {
        $a = Metric::download();
        $b = Metric::upload();
        $c = Metric::packetLoss();

        $this->assertEquals($a, $a);
        $this->assertEquals($b, $b);
        $this->assertEquals($c, $c);

        $this->assertNotEquals($a, $b);
        $this->assertNotEquals($a, $c);
        $this->assertNotEquals($b, $c);
    }

    /**
     * @test
     */
    public function canBeInstantiatedFromString()
    {
        $this->assertEquals(Metric::download(), Metric::fromString('download'));
        $this->assertEquals(Metric::upload(), Metric::fromString('upload'));
        $this->assertEquals(Metric::latency(), Metric::fromString('latency'));
        $this->assertEquals(Metric::packetLoss(), Metric::fromString('packet_loss'));
    }
}
