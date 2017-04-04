<?php

require __DIR__.'/vendor/autoload.php';

use SamKnows\BackendTest\ImportInteractor;
use SamKnows\BackendTest\ReportInteractor;
use SamKnows\BackendTest\HourSummaryMemoryRepo;
use SamKnows\BackendTest\DataPointService;
use SamKnows\BackendTest\Unit;
use SamKnows\BackendTest\Metric;
use SamKnows\BackendTest\Hour;

$repo = new HourSummaryMemoryRepo;
$dataPointService = new DataPointService($repo);

$repo = new HourSummaryMemoryRepo(); 
$dataPointService = new DataPointService($repo);
$importer = new ImportInteractor($dataPointService);
$importer->execute();

$reporter = new ReportInteractor($repo);

$unit = new Unit('1');
$metric = Metric::download();
$hour = Hour::fromTimestamp('2017-02-22 10:00:00'); 
$report = $reporter->execute($unit, $metric, $hour);
print_r($report);
