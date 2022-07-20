<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
@set_time_limit(9000);
@ini_set('max_execution_time', '9000');

require_once '../vendor/autoload.php';

$connection = new \BoxberryListPoints\DateBase\Connection();
$dataBase = new \BoxberryListPoints\DateBase\DataBase($connection->connect());

$sql = file_get_contents('./TableList.sql');
$dataBase->execution($sql);

echo "Выполнен запрос к базе данный на добавление новых таблиц! ";
