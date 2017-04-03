<?php

namespace SamKnows\BackendTest;

use DateTime;

class Hour {

    private $year;
    private $month;
    private $day;
    private $hour;

    public function __construct(int $year, int $month, int $day, int $hour)
    {
        $this->year = $year;
        $this->month = $month;
        $this->day = $day;
        $this->hour = $hour;
    }

    public function fromTimestamp(string $ts): Hour
    {
        $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $ts);
        $year = $dateTime->format('Y');
        $month = $dateTime->format('m');
        $day = $dateTime->format('d');
        $hour = $dateTime->format('h');

        return new self($year, $month, $day, $hour);
    }

    public function __toString()
    {
        $day = str_pad($this->day, 2, "0", STR_PAD_LEFT);
        $month = str_pad($this->month, 2, "0", STR_PAD_LEFT);
        $hour = str_pad($this->hour, 2, "0", STR_PAD_LEFT);
        return "{$this->year}-{$month}-{$day} {$hour}"; 
    }
}
