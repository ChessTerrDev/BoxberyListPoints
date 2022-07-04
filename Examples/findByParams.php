<?php


use BoxberryListPoints\Models\Metro as MetroModel;

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once '../vendor/autoload.php';

$metro = new MetroModel();

var_dump($metro
    ->setMetroName('Щёлковская')
    ->find());
