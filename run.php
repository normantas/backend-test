<?php

require __DIR__.'/vendor/autoload.php';

use SamKnows\BackendTest\ImportInteractor;
use SamKnows\BackendTest\ReportInteractor;
use SamKnows\BackendTest\HourSummaryMemoryRepo;
use SamKnows\BackendTest\DataPointService;

$repo = new HourSummaryMemoryRepo;
$dataPointService = new DataPointService($repo);

$repo = new HourSummaryMemoryRepo(); 
$dataPointService = new DataPointService($repo);
$importer = new ImportInteractor($dataPointService);
$importer->execute();

$reporter = new ReportInteractor($repo);
$reporter->execute();
