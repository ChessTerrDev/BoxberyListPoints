<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
set_time_limit(9000);

require_once __DIR__.'/../../vendor/autoload.php';

use BoxberryListPoints\Libs\MultiProcessing;
use BoxberryListPoints\Libs\Logger;



$scriptPath = __DIR__ . '/Worker.php';
$param = json_decode(file_get_contents(\BoxberryListPoints\Configuration\Constants::TMP_PATH.'ListPoints.json'), true);

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

$multiProcessing = new MultiProcessing($scriptPath, $param);
$multiProcessing
    ->setSumOfProcesses(10)
    ->setStartCallbackFunction($startCallbackFunction)
    ->setFinishCallbackFunction($finishCallbackFunction);

$multiProcessing->run();

