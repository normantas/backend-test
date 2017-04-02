<?php

namespace SamKnows\BackendTest;

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
}
