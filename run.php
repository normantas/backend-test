<?php

require __DIR__.'/vendor/autoload.php';

use SamKnows\BackendTest\ImportInteractor;
use SamKnows\BackendTest\ReportInteractor;
use SamKnows\BackendTest\HourSummaryDbRepo;
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
use Symfony\Component\Console\Helper\Table;


$conf = require __DIR__ . '/conf.php';
$repo = new HourSummaryDbRepo($conf['db']); 
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

		$this->addArgument('unit', InputArgument::REQUIRED, 'Unit ID');
		$this->addArgument('metric', InputArgument::REQUIRED, 'Metric');
		$this->addArgument('hour', InputArgument::REQUIRED, 'Timestamp of an hour');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
		// TODO: validation messages
        $unit = new Unit($input->getArgument('unit'));
        $metric = Metric::fromString($input->getArgument('metric'));
        $hour = Hour::fromTimestamp($input->getArgument('hour')); 

        $report = $this->interactor->execute($unit, $metric, $hour);

        $table = new Table($output);
        $table->setHeaders(
			['Date', 'Mean', 'Median', 'Minimum', 'Maximum', 'Sample Size']
		);
		foreach ($report as $line) {
            $table->addRow([
				$line['date'],
				$line['mean'],
				$line['median'],
				$line['minimum'],
				$line['maximum'],
				$line['sampleSize'],
			]);
		}
        $table->render(); 
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

