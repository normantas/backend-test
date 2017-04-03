<?php

namespace SamKnows\BackendTest;

class ImportInteractor {

    public function execute()
    {
        $json = file_get_contents('testdata.json');
        $data = json_decode($json);
        print_r($data);
    }
}
