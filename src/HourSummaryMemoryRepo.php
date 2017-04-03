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
        $time = $summary->getHour()->getTime();
        $date = $summary->getHour()->getDate();

        $key = $unit . '/' . $metric . '/';
        if (!isset($data[$key])) {
            $data[$key] = [];
        }

        $data[$key][$date] = [
            'mean' => $summary->getMean(),
            'median' => $summary->getMedian(),
            'minimum' => $summary->getMinimum(),
            'maximum' => $summary->getMaximum(),
            'sampleSize' => $summary->getSampleSize(),
        ];
    }
}
