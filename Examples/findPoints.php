<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once '../vendor/autoload.php';

use \BoxberryListPoints\Controllers\ListPointShort;
use \BoxberryListPoints\Controllers\ListPoint;

/*var_dump(value: ListPointShort::findPointShortByAddress('Москва', 'Карманицкий'));
var_dump(value: ListPointShort::findPointShortByCityName('Москва'));
var_dump(value: ListPointShort::findPointShortBySettlement('Кумертау'));

var_dump(value: ListPointShort::findPointShortByCode('19908'));
var_dump(value: ListPointShort::findPointShortById(1692));
var_dump(value: ListPointShort::findPointShortByZipCode(101000));*/

var_dump(value: ListPointShort::findAllPointsShort());

//var_dump(value: ListPoint::findPointByCode('19908'));