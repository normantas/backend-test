<?php

namespace SamKnows\BackendTest;

class HourSummaryMemoryRepo implements HourSummaryWriteRepoInterface
{
    private $data;

    public function __construc()
    {
        $data = [];
    }

    public function save(HourSummary $summary)
    {
        $unit = $summary->getUnit()->__toString();
        $metric = $summary->getMetric()->__toString();
        $key = $unit . '/' . $metric;
        if (!isset($data[$key])) {
            $data[$key] = [];
        }

        $hour = $summary->getHour()->__toString();
        $data[$key][$hour] = [
            'mean' => $summary->getMean(),
            'median' => $summary->getMedian(),
            'minimum' => $summary->getMinimum(),
            'maximum' => $summary->getMaximum(),
            'sampleSize' => $summary->getSampleSize(),
        ];
    }
}
