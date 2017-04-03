<?php

namespace SamKnows\BackendTest;

interface HourSummaryWriteRepoInterface
{
    public function save(HourSummary $summary);
}
