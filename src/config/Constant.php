<?php

return [
    'connections'       => [
        'mysql'         =>  [
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'php_test_nals',
            'username'  => 'root',
            'password'  => '',
        ],
    ],
    'status'            => [
        '0'             => 'Planning',
        '1'             => 'Doing',
        '2'             => 'Completed',
    ],
    'app_name'          => 'php_test_nals',
];