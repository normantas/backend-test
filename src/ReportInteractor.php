<?php

namespace SamKnows\BackendTest;

class ReportInteractor
{
    public function __construct(HourSummaryReadRepoInterface $repo)
    {
        $this->repo = $repo; 
    }

    public function execute()
    {
        $unit = new Unit('1');
        $metric = Metric::download();
        $hour = Hour::fromTimestamp('2017-02-22 10:00:00'); 
        $report = $this->repo->get($unit, $metric, $hour); 
        print_r($report);
    }
}
