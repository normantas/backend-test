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
            [3.14]
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
    

    public function medianSamples()
    {
        return [
            [[11, 23, 30, 47, 56], 30],
            [[11, 23, 30, 47, 52, 56], 38.5]
        ];
    }

    /**
     * @test
     * @dataProvider medianSamples
     */
    public function getsMedian($values, $expectedMedian)
    {
        $sum = new HourSummary(
            new Unit('unit-1'), 
            Metric::download(),
            new Hour(2001, 1, 1, 1),
            $values 
        );
        $this->assertEquals($expectedMedian, $sum->getMedian()); 
    }

    /**
     * @test
     */
    public function getsMean()
    {
        $values = [ 1, 2, 3, 4];
        $sum = new HourSummary(
            new Unit('unit-1'), 
            Metric::download(),
            new Hour(2001, 1, 1, 1),
            $values 
        );
        $this->assertEquals(2.5, $sum->getMean()); 
    }

    /**
     * @test
     */
    public function getsMinimum()
    {
        $values = [ 1, 2, 3, 4];
        $sum = new HourSummary(
            new Unit('unit-1'), 
            Metric::download(),
            new Hour(2001, 1, 1, 1),
            $values 
        );
        $this->assertEquals(1, $sum->getMinimum()); 
    }

    /**
     * @test
     */
    public function getsMaximum()
    {
        $values = [ 1, 2, 3, 4];
        $sum = new HourSummary(
            new Unit('unit-1'), 
            Metric::download(),
            new Hour(2001, 1, 1, 1),
            $values 
        );
        $this->assertEquals(4, $sum->getMaximum()); 
    }

    /**
     * @test
     */
    public function getsSampleSize()
    {
        $values = [ 1, 2, 3, 5];
        $sum = new HourSummary(
            new Unit('unit-1'), 
            Metric::download(),
            new Hour(2001, 1, 1, 1),
            $values 
        );
        $this->assertEquals(4, $sum->getSampleSize()); 
    }
}
