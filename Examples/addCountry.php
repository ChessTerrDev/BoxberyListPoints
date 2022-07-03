<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once '../vendor/autoload.php';

$countries = new \BoxberryListPoints\Models\Countries();
$countries
    ->setCountryCode(051)
    ->setCountryName('Армения');
$countries->addEntryInDataBase(null, null);