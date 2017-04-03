<?php

namespace SamKnows\BackendTest;

class HourSummary {

    private $unit;
    private $metric;
    private $hour;
    private $values;

    public function __construct(Unit $unit, Metric $metric, Hour $hour, array $values)
    {
        $this->unit = $unit;
        $this->metric = $metric;
        $this->hour = $hour;
        $this->values = $values;
    }

    public function getUnit(): Unit
    {
        return $this->unit;
    }

    public function getMetric(): Metric
    {
        return $this->metric;
    }

    public function getHour(): Hour
    {
        return $this->hour;
    }

    public function getValues(): array
    {
        return $this->values;
    }

    public function getMean(): float
    {
        return array_sum($this->values)/count($this->values);
    }

    public function getMedian(): float
    {
        sort($this->values);
        $count = count($this->values);
        $middle = floor(($count-1)/2);
        if ($count % 2) {
            $median = $this->values[$middle];
        } else {
            $low = $this->values[$middle];
            $high = $this->values[$middle+1];
            $median = (($low+$high)/2);
        }
        return $median;
    }

    public function getMinimum(): float
    {
        return min($this->values);
    }

    public function getMaximum(): float
    {
        return max($this->values);
    }

    public function getSampleSize(): float
    {
        return count($this->values);
    }
}
