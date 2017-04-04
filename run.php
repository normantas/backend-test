<?php

require __DIR__.'/vendor/autoload.php';

use SamKnows\BackendTest\ImportInteractor;
use SamKnows\BackendTest\ReportInteractor;
use SamKnows\BackendTest\HourSummaryMemoryRepo;
use SamKnows\BackendTest\DataPointService;
use SamKnows\BackendTest\Unit;
use SamKnows\BackendTest\Metric;
use SamKnows\BackendTest\Hour;
use SamKnows\BackendTest\LocalFileInputProvider;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Application;

$repo = new HourSummaryMemoryRepo(); 
$dataPointService = new DataPointService($repo);
$filename = 'testdata.json';
$inputProvider = new LocalFileInputProvider($filename);
$importer = new ImportInteractor($dataPointService, $inputProvider);
$reporter = new ReportInteractor($repo);

class ImportCommand extends Command
{
	private $interactor;

    protected function configure()
    {
		$this
			->setName('import')
			->setDescription('Imports data from file.')
			->setHelp('Imports data from file');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
		$this->interactor->execute();
		$output->writeln('Data imported!');
    }

	public function setInteractor(ImportInteractor $interactor)
	{
		$this->interactor = $interactor;
	}
}

class ReportCommand extends Command
{
	private $interactor;

    protected function configure()
    {
		$this
			->setName('report')
			->setDescription('Reports monthly activity on certain hour.')
			->setHelp('');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $unit = new Unit('1');
        $metric = Metric::download();
        $hour = Hour::fromTimestamp('2017-02-22 10:00:00'); 
        $report = $this->interactor->execute($unit, $metric, $hour);
		$output->writeln('Report completed!');
    }

	public function setInteractor(ReportInteractor $interactor)
	{
		$this->interactor = $interactor;
	}
}

$application = new Application();

$importCmd = new ImportCommand();
$importCmd->setInteractor($importer);
$application->add($importCmd);

$reportCmd = new ReportCommand();
$reportCmd->setInteractor($reporter);
$application->add($reportCmd);

$application->run();

