<?php

namespace SamKnows\BackendTest;

class Metric {

    const TYPE_DOWNLOAD = 0;
    const TYPE_UPLOAD = 1;
    const TYPE_LATENCY = 2;
    const TYPE_PACKET_LOSS = 3;

    private $type;

    private function __construct(string $type)
    {
        $this->type = $type;
    }

    public function download(): Metric
    {
        return new self(self::TYPE_DOWNLOAD); 
    }

    public function upload(): Metric
    {
        return new self(self::TYPE_UPLOAD); 
    }

    public function latency(): Metric
    {
        return new self(self::TYPE_LATENCY); 
    }

    public function packetLoss(): Metric
    {
        return new self(self::TYPE_PACKET_LOSS); 
    }

    public function fromString(string $type): Metric
    {
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
                throw new InvalidArgumentException("Cannot create metric");
        }
        return $metric;
    }
}
