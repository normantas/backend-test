<?php

require __DIR__.'../../../vendor/autoload.php';

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use PHPUnit_Framework_Assert as a;

use SamKnows\BackendTest\ImportInteractor;
use SamKnows\BackendTest\ReportInteractor;
use SamKnows\BackendTest\HourSummaryMemoryRepo;
use SamKnows\BackendTest\DataPointService;
use SamKnows\BackendTest\Unit;
use SamKnows\BackendTest\Metric;
use SamKnows\BackendTest\Hour;
use SamKnows\BackendTest\LocalFileInputProvider;

class FeatureContext implements Context
{
    private $repo;
    private $report;
    /**
     * @Given :filename is imported
     */
    public function isImported($filename)
    {
        $this->repo = new HourSummaryMemoryRepo;
        $dataPointService = new DataPointService($this->repo);
        $inputProvider = new LocalFileInputProvider($filename);
        $importer = new ImportInteractor($dataPointService, $inputProvider);

        $importer->execute();
    }

    /**
     * @When ask for :metricName from unit :unitId on :dateTime
     */
    public function askForFromUnitOn($unitId, $metricName, $dateTime)
    {
        $reporter = new ReportInteractor($this->repo);

        $unit = new Unit($unitId);
        $metric = Metric::fromString($metricName);
        $hour = Hour::fromTimestamp($dateTime); 

        $this->report = $reporter->execute($unit, $metric, $hour);
    }

    /**
     * @Then reports:
     */
    public function reports(TableNode $table)
    {
        foreach($table as $key => $row) {
            $summary = current($this->report);

			$num = $key + 1;
			$line = $num . ':| ' . join(' | ', $row) . ' |';

            a::assertEquals($row['Mean'], $summary['mean'],
                "Mean not match expected in line:\n$line");
            a::assertEquals($row['Median'], $summary['median'],
                "Median not match expected in line:\n$line");
            a::assertEquals($row['Minimum'], $summary['minimum'],
                "Minimum not match expected in line:\n$line");
            a::assertEquals($row['Maximum'], $summary['maximum'],
                "Maximum not match expected in line:\n$line");
            a::assertEquals($row['Sample Size'], $summary['sampleSize'],
                "Sample size not match expected in line:\n$line");

			next($this->report);
        }
    }
}
