<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
set_time_limit(9000);

require_once './vendor/autoload.php';



$callbackFunction = function () {
    (new \BoxberryListPoints\Libs\Logger('MultiProcessing'))
        ->addLogInfo("Script started... \n");
};


$arr = json_decode(file_get_contents(\BoxberryListPoints\Configuration\Constants::TMP_PATH.'ListPoints.json'), true);
new \BoxberryListPoints\Libs\MultiProcessing(__DIR__ . '/Worker.php', $arr, $callbackFunction);