<?php

namespace SamKnows\BackendTest;

class HourSummary {

    private $unit;
    private $metric;
    private $hour;
    private $value;

    public function __construct(Unit $unit, Metric $metric, Hour $hour, float $value)
    {
        $this->unit = $unit;
        $this->metric = $metric;
        $this->hour = $hour;
        $this->value = $value;
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

    public function getValue(): float
    {
        return $this->value;
    }

    public function getMean(): float
    {
        return $this->value;
    }

    public function getMedian(): float
    {
        return $this->value;
    }

    public function getMinimum(): float
    {
        return $this->value;
    }

    public function getMaximum(): float
    {
        return $this->value;
    }

    public function getSampleSize(): float
    {
        return $this->value;
    }
}
