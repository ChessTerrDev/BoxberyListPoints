<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once '../vendor/autoload.php';

$countries = new \BoxberryListPoints\Models\Countries();
$countries
    ->setCountryCode(643)
    ->setCountryName('Россия');
$countries->addEntry(null, null);

$countries = new \BoxberryListPoints\Models\Countries();
$countries
    ->setCountryCode(398)
    ->setCountryName('Казахстан');
$countries->addEntry(null, null);

$countries = new \BoxberryListPoints\Models\Countries();
$countries
    ->setCountryCode(112)
    ->setCountryName('Беларусь');
$countries->addEntry(null, null);

$countries = new \BoxberryListPoints\Models\Countries();
$countries
    ->setCountryCode(417)
    ->setCountryName('Киргизия');
$countries->addEntry(null, null);

$countries = new \BoxberryListPoints\Models\Countries();
$countries
    ->setCountryCode(051)
    ->setCountryName('Армения');
$countries->addEntry(null, null);


