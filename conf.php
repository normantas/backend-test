<?php
return [
    // To create a db for dev:
    // `docker run -v $(pwd)/schema:/docker-entrypoint-initdb.d -p13306:3306 -e MYSQL_ROOT_PASSWORD=my-secret-pw mysql`

    'db' => [
        'host' => '0.0.0.0',
        'port' => '13306',
        'user' => 'root',
        'pass' => 'my-secret-pw',
        'dbname' => 'skdb'
    ]
];
