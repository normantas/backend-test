<?php

namespace SamKnows\BackendTest;

class ImportInteractor
{
    private $dataPointService;

    public function __construct(DataPointService $service)
    {
        $this->dataPointService = $service;
    }

    public function execute()
    {
        $json = file_get_contents('testdata.json');
        $data = json_decode($json);
        foreach ($data as $unit) {
            $unitId = $unit->unit_id;
            $metrics = $unit->metrics;
            foreach ($metrics as $type => $dataPoints) {
                $unit = new Unit($unitId);
                $metric = Metric::fromString($type);
                $this->dataPointService->saveAggregatedByHour($unit, $metric, $dataPoints);
            }
        }
    }
}
