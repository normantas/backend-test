<?php

namespace SamKnows\BackendTest;

class DataPointService
{
    private $repo;

    public function __construct(HourSummaryWriteRepoInterface $repo)
    {
        $this->repo = $repo;
    }

    public function saveAggregatedByHour(Unit $unit, Metric $metric, array $dataPoints)
    {
        // Map it to newValues
        $newValues = [];
        foreach ($dataPoints as $dataPoint) {
            
            $hour =  Hour::fromTimestamp($dataPoint->timestamp);
            $value = $dataPoint->value;

            if (isset($newValues["$hour"])) {
                $newValues["$hour"][] = $dataPoint->value;
            } else {
                $newValues["$hour"] = [$dataPoint->value];
            }
        }

        // Aggregate
        foreach ($newValues as $hourTs => $vals) {
            $hour =  Hour::fromTimestamp($hourTs);
            $summary = new HourSummary($unit, $metric, $hour, $vals);
            $this->repo->save($summary);
        }
    }
}

