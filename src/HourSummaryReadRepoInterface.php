<?php

namespace SamKnows\BackendTest;

interface HourSummaryReadRepoInterface
{
    public function get(Unit $unit, Metric $metric, Hour $hour): array;
}
