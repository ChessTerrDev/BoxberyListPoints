<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once '/var/www/phpstorm/BoxberyListPoints/vendor/autoload.php';

use BoxberryListPoints\Controllers\Update\ListPoints\PointsDescription;

$options = getopt("c::p::", ['code::', 'photo::']);

if (empty($_GET['code']) && empty($options["code"]) && empty($options["c"]))
    throw new \Exception('Пустой идентификатор ПВЗ!');

$code = $_GET['code'] ?? $options["code"] ?? $options["c"];



$pointDescription = new PointsDescription((string)$code);
$pointDescription->loadPointsDescription();


var_dump($pointDescription->toObject());

/*(new \BoxberryListPoints\Libs\Logger('Worker'))
    ->addLogInfo('Получен результат: ' . $pointDescription->toJson());*/