<?php

namespace SamKnows\BackendTest;

class ImportInteractor
{
    private $dataPointService;
    private $inputProvider;

    public function __construct(
        DataPointService $service,
        InputProviderInterface $provider
    ) {
        $this->dataPointService = $service;
        $this->inputProvider = $provider;
    }

    public function execute()
    {
        $json = $this->inputProvider->read();
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
