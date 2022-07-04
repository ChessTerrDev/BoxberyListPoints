<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once '../vendor/autoload.php';

use \BoxberryListPoints\Controllers\ListPoint;

var_dump(value: ListPoint::findPointByAddress('Москва', 'Карманицкий'));
var_dump(value: ListPoint::findPointByCityName('Москва'));
var_dump(value: ListPoint::findPointBySettlement('Кумертау'));

var_dump(value: ListPoint::findPointByCode('6123'));
var_dump(value: ListPoint::findPointById(1692));
var_dump(value: ListPoint::findPointByZipCode(101000));