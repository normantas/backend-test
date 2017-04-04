<?php

namespace SamKnows\BackendTest;

class LocalFileInputProvider implements InputProviderInterface
{
    private $filename;
    
    public function __construct(string $filename)
    {
        $this->filename = $filename;
    }

    public function read(): string
    {
        return file_get_contents($this->filename);
    }
}
