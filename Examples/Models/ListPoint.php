<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
set_time_limit(9000);

require_once __DIR__ . '/../../vendor/autoload.php';

$point = new \BoxberryListPoints\Models\ListPoints();
$point->setCode('19908');
$point->find();

var_dump($point);
