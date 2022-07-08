<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once '/var/www/phpstorm/BoxberyListPoints/vendor/autoload.php';

use BoxberryListPoints\Controllers\Update\ListPoints\PointsDescription;
use BoxberryListPoints\Controllers\ListPoint;

/**
 * Принимаем параметры
 */
$options = getopt("", ['Code::', 'UpdateDate::']);
$code = $options["Code"] ?? null;
$updateDate = $options["UpdateDate"] ?? null;

if (empty($code))
    throw new \Exception('Пустой идентификатор ПВЗ!');


/**
 * Получаем подробную информацию о ПВЗ
 */
$pointDescription = new PointsDescription((string)str_replace('"', '', $code));
$description = $pointDescription
    ->loadPointsDescription()
    ->toArray();

$description['UpdateDate'] = $updateDate ? preg_replace("/\s\d{2}:\d{2}:\d{2}/", '', str_replace('"', '', $updateDate)) : date('Y-m-d');

var_dump($description);
/**
 * Добавляем запись в БД
 */
$result = ListPoint::addPoint($description);

//(new*/ \BoxberryListPoints\Libs\Logger('Worker'))->addLogInfo('Получен результат: ' . json_encode($result->getFields()));