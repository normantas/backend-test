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
}
