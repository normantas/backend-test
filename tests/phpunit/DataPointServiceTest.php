<?php

namespace SamKnows\BackendTest;

use PHPUnit_Framework_TestCase;
use stdClass;
use Prophecy\Argument;

class DataPointServiceTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function aggregatesByHourAndSavesDataPoints()
    {
        // Arrange
        $repo = $this->prophesize(HourSummaryWriteRepoInterface::class);
        $service = new DataPointService($repo->reveal()); 

        $unit = new Unit('unit-1');
        $metric = Metric::download();

        $p1 = new stdClass; 
        $p1->value = 2; 
        $p1->timestamp = '2017-01-01 03:15:00'; 
        $p2 = new stdClass; 
        $p2->value = 4; 
        $p2->timestamp = '2017-01-01 03:45:00'; 
        $p3 = new stdClass; 
        $p3->value = 8; 
        $p3->timestamp = '2017-01-01 04:15:00'; 
        $dataPoints = [$p1, $p2, $p3];

        // Act
        $service->saveAggregatedByHour($unit, $metric, $dataPoints);

        // Assert
        $hour1 = Hour::fromTimestamp('2017-01-01 03:00:00');
        $sum1 = new HourSummary($unit, $metric, $hour1, [2, 4]);

        $hour2 = Hour::fromTimestamp('2017-01-01 04:00:00');
        $sum2 = new HourSummary($unit, $metric, $hour2, [8]);

        $repo->save($sum1)->shouldHaveBeenCalled();
        $repo->save($sum2)->shouldHaveBeenCalled();
        $repo->save(Argument::any())->shouldHaveBeenCalledTimes(2);
    }
}
