<?php

namespace SamKnows\BackendTest;

class ReportInteractor
{
    public function __construct(HourSummaryReadRepoInterface $repo)
    {
        $this->repo = $repo; 
    }

    public function execute(Unit $unit, Metric $metric, Hour $hour): array
    {
        return $this->repo->get($unit, $metric, $hour); 
    }
}
