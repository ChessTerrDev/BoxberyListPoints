<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
set_time_limit(9000);

require_once __DIR__ . '/../../vendor/autoload.php';

use BoxberryListPoints\Libs\MultiProcessing;
use BoxberryListPoints\Libs\Logger;
use BoxberryListPoints\Controllers\Update\ListPoints\ListPointsShort;
use BoxberryListPoints\Controllers\ListPointShort;

// Список записей из БД
$listUpdateDate = [];
$listPointsFromBD = ListPointShort::findAllPointsShort(['Code', 'UpdateDate']);
foreach ($listPointsFromBD as $point)
    $listUpdateDate[(string)$point['Code']] = $point['UpdateDate'];
//unset($listPointsFromBD);

// Список актуальных записей из БД Боксбери
$listPoints = new ListPointsShort();
$listPoints->loadFullListPoints();
//$listPoints->loadCountryListPoints(643);
//$listPoints->loadCityListPoints(643, '77400');
$param = $listPoints->toArray();


// Оставляем только те записи которых нет в нашей базе или другая дата обновления
$listPointsToUpdate = [];
foreach ($param as $key => $point) {
    $point['UpdateDate'] = preg_replace("/\s\d{2}:\d{2}:\d{2}/", '', $point['UpdateDate']);

    if (isset($listUpdateDate[(string)$point['Code']]) && $listUpdateDate[(string)$point['Code']] !== $point['UpdateDate']) {
        $point['oldData'] = $listUpdateDate[(string)$point['Code']];
        $listPointsToUpdate[] = $point;
    }
}
unset($listUpdateDate);
unset($param);



$scriptPath = __DIR__ . '/Worker.php';


$startCallbackFunction = function ($message) {
    echo "The script is running: $message  \n";
    (new Logger('Worker'))
        ->addLogInfo("The script is running: $message \n");
};
$finishCallbackFunction = function ($message) {
    echo "The script is completed: $message  \n";
    (new Logger('Worker'))
        ->addLogInfo("The script is completed: $message \n");
};

$multiProcessing = new MultiProcessing($scriptPath, $listPointsToUpdate);
$multiProcessing
    ->setSumOfProcesses(10)
    ->setStartCallbackFunction($startCallbackFunction)
    ->setFinishCallbackFunction($finishCallbackFunction);

$statistics = $multiProcessing->run();


echo "-------------------------------------------------------------------- \n";
echo "Starting number of entries: " . $statistics['startingNumberEntries'] . "\n";
echo "Processes started: " . $statistics['processesStarted'] . "\n";
echo "Number of process startup cycles: " . $statistics['processStartupCycles'] . "\n";
echo "Completed processes: " . $statistics['completedProcesses'] . "\n";
echo "Script execution time: " . round(($statistics['scriptExecutionTime']/60), 2) . " мин \n";
echo "Amount of memory used: " . round(memory_get_usage(true)/1024, 2) . " kilobites \n";
echo "-------------------------------------------------------------------- \n";


