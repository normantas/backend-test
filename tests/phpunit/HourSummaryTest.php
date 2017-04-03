<?php

namespace SamKnows\BackendTest;

use PHPUnit_Framework_TestCase;

class HourSummaryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function canBeCreated()
    {
        $sum = new HourSummary(
            new Unit('unit-1'), 
            Metric::download(),
            new Hour(2001, 1, 1, 1),
            3.14
        );

        $this->assertEquals(new Unit('unit-1'), $sum->getUnit());
        $this->assertEquals(Metric::download(), $sum->getMetric());
        $this->assertEquals(new Hour(2001, 1, 1, 1), $sum->getHour());
        $this->assertEquals([3.14], $sum->getValues());
        $this->assertEquals(3.14, $sum->getMean());
        $this->assertEquals(3.14, $sum->getMedian());
        $this->assertEquals(3.14, $sum->getMinimum());
        $this->assertEquals(3.14, $sum->getMaximum());
        $this->assertEquals(1, $sum->getSampleSize());
    }
}
