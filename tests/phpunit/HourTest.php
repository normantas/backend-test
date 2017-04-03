<?php

namespace SamKnows\BackendTest;

use PHPUnit_Framework_TestCase;

class HourTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function hoursCanBeCompared()
    {
        $a = new Hour(2017, 1, 10, 1);
        $b = new Hour(2017, 1, 10, 1);
        $c = new Hour(2017, 1, 1, 1);
        $this->assertEquals($a, $b);
        $this->assertNotEquals($a, $c);
        $this->assertNotEquals($b, $c);
    }

    /**
     * @test
     */
    public function canBeConvertedToString()
    {
        $this->assertEquals((new Hour(2017, 1, 10, 1))->__toString(), "2017-01-10 01");

    }
}
