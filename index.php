<?php

require 'src/config/Log.php';
require 'src/config/Connection.php';
require 'src/models/Work.php';

$pdo = Connection::make();

$work = new Work($pdo);

$works = $work->getData();

// $dateNow  = new DateTime();
// $start_at = $dateNow->format('Y-m-d H:i:s');
// $end_at   = $dateNow->modify('+2 days')->format('Y-m-d H:i:s');

// $rsCreate = $work->insert(
//     'demo 3',
//     $start_at,
//     $end_at,
//     0
// );

// if ($rsCreate) {
//     echo 'oke';
// } else {
//     echo 'error';
// }

require './src/views/index.php';
