<?php

namespace BoxberryListPoints\Libs;

use BoxberryListPoints\Configuration\Constants;
use Monolog\{Logger as MonologLogger, Handler\StreamHandler};

class Logger
{
    private object $log;

    public function __construct($name)
    {
        $this->log = $log = new MonologLogger($name);

        $log->pushHandler(new StreamHandler(Constants::LOG_FILES_PATH['EMERGENCY'], MonologLogger::EMERGENCY));
        $log->pushHandler(new StreamHandler(Constants::LOG_FILES_PATH['ALERT'], MonologLogger::ALERT));
        $log->pushHandler(new StreamHandler(Constants::LOG_FILES_PATH['CRITICAL'], MonologLogger::CRITICAL));
        $log->pushHandler(new StreamHandler(Constants::LOG_FILES_PATH['ERROR'], MonologLogger::ERROR));
        $log->pushHandler(new StreamHandler(Constants::LOG_FILES_PATH['WARNING'], MonologLogger::WARNING));
        $log->pushHandler(new StreamHandler(Constants::LOG_FILES_PATH['NOTICE'], MonologLogger::NOTICE));
        $log->pushHandler(new StreamHandler(Constants::LOG_FILES_PATH['INFO'], MonologLogger::INFO));
        $log->pushHandler(new StreamHandler(Constants::LOG_FILES_PATH['DEBUG'], MonologLogger::DEBUG));
    }

    public function addLogEmergency($message, $context = [])
    {
        $this->log->emergency($message, $context);
    }

    public function addLogAlert($message, $context = [])
    {
        $this->log->alert($message, $context);
    }

    public function addLogCritical($message, $context = [])
    {
        $this->log->critical($message, $context);
    }

    public function addLogError($message, $context = [])
    {
        $this->log->error($message, $context);
    }

    public function addLogWarning($message, $context = [])
    {
        $this->log->warning($message, $context);
    }

    public function addLogNotice($message, $context = [])
    {
        $this->log->notice($message, $context);
    }

    public function addLogInfo($message, $context = [])
    {
        $this->log->info($message, $context);
    }

    public function addLogDebug($message, $context = [])
    {
        $this->log->debug($message, $context);
    }
}