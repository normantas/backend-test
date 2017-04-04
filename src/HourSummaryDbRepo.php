<?php

namespace SamKnows\BackendTest;

use PDO;
use DateTime;

class HourSummaryDbRepo
    implements HourSummaryWriteRepoInterface, HourSummaryReadRepoInterface
{
    private $conn;

    public function __construct(array $config)
    {
        print_r($config);
        $host = $config['host'];
        $port = $config['port'];
        $user = $config['user'];
        $pass = $config['pass'];
        $dbname = $config['dbname'];
        $this->conn = new PDO(
            "mysql:host=$host;port=$port;dbname=$dbname",
            $user,
            $pass
        );
        $this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION ); 
    }

    public function save(HourSummary $summary)
    {
        $unit = $summary->getUnit()->__toString();
        $metric = $summary->getMetric()->getType();
        $dateTime = DateTime::createFromFormat(
            'Y-m-d H:i:s',
            $summary->getHour()->__toString()
        );
        $year = $dateTime->format('Y');
        $month = $dateTime->format('m');
        $day = $dateTime->format('d');
        $hour = $dateTime->format('H'); 
        $mean = $summary->getMean();
        $median = $summary->getMedian();
        $minimum = $summary->getMinimum();
        $maximum = $summary->getMaximum();
        $sampleSize = $summary->getSampleSize();

        $sql = "INSERT INTO hour_summary SET unit=?, metric=?, "
             . "year=?, month=?, day=?, hour=?, "
             . "mean=?, median=?, minimum=?, maximum=?, sample_size=?";
        $stmt = $this->conn->prepare($sql);
        $rc = $stmt->execute([
            $unit, $metric, $year, $month, $day, $hour,
            $mean, $median, $minimum, $maximum, $sampleSize
        ]);
    }

    public function get(Unit $unit, Metric $metric, Hour $hour): array
    {
        $unit = $unit->__toString();
        $metric = $metric->getType();
        $time = $hour->getTime();
        $date = $hour->getDate();
        $dateTime = DateTime::createFromFormat(
            'Y-m-d H:i:s',
            $hour->__toString()
        );
        $hourOfDay = $dateTime->format('H'); 

        $sth = $this->conn->prepare(
            "SELECT mean, median, minimum, maximum, sample_size AS sampleSize " . 
            "FROM hour_summary WHERE unit=? AND metric=? AND hour=?"
        );
        $sth->execute([$unit, $metric, $hourOfDay]);

        $result = $sth->fetchAll();

        return $result;
    }
}
