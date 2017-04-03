<?php

namespace SamKnows\BackendTest;

class HourSummaryMemoryRepo
    implements HourSummaryWriteRepoInterface, HourSummaryReadRepoInterface
{
    private $data;

    public function __construc()
    {
        $this->data = [];
    }

    public function save(HourSummary $summary)
    {
        $unit = $summary->getUnit()->__toString();
        $metric = $summary->getMetric()->__toString();
        $time = $summary->getHour()->getTime();
        $date = $summary->getHour()->getDate();

        $key = $unit . '/' . $metric . '/'. $time;
        if (!isset($this->data[$key])) {
            $this->data[$key] = [];
        }

        $this->data[$key][$date] = [
            'mean' => $summary->getMean(),
            'median' => $summary->getMedian(),
            'minimum' => $summary->getMinimum(),
            'maximum' => $summary->getMaximum(),
            'sampleSize' => $summary->getSampleSize(),
        ];
    }

    public function get(Unit $unit, Metric $metric, Hour $hour): array
    {
        $unit = $unit->__toString();
        $metric = $metric->__toString();
        $time = $hour->getTime();
        $date = $hour->getDate();

        $key = $unit . '/' . $metric . '/' . $time;
        if (empty($this->data[$key])) {
            return [];
        }
        ksort($this->data[$key]);
        return $this->data[$key];
    }
}
