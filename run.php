<?php

require __DIR__.'/vendor/autoload.php';

use SamKnows\BackendTest\ImportInteractor;
$importer = new ImportInteractor;
$importer->execute();
