<?php

namespace SamKnows\BackendTest;


class ImportInteractor {

    public function execute()
    {
        $json = file_get_contents('testdata.json');
        $data = json_decode($json);
        foreach ($data as $unit) {
            $unitId = $unit->unit_id;
            $metrics = $unit->metrics;
            foreach ($metrics as $type => $dataPoints) {
                switch($type) {
                    case 'download':
                        $metric = Metric::download();
                        break;
                    case 'upload':
                        $metric = Metric::upload();
                        break;
                    case 'latency':
                        $metric = Metric::latency();
                        break;
                    case 'packet_loss':
                        $metric = Metric::packetLoss();
                        break;
                    default:
                }

                foreach ($dataPoints as $dataPoint) {
                    
                    $hour =  Hour::fromTimestamp($dataPoint->timestamp);
                    $value = $dataPoint->value;

                    $summary = new HourSummary(
                        new Unit($unitId),
                        $metric,
                        $hour,
                        [$value]
                    );
                    

                }
            }

        }
    }
}
