<?php

namespace BoxberryListPoints\Libs;

use Symfony\Component\Process\Process;

class MultiProcessing
{
    private array $pullProcess;

    public function __construct(string $scriptPath, array $params, ?callable $callbackFunction = null)
    {
        foreach ($params as $param) {

            $this->initProcess($scriptPath, $param['Code'], $callbackFunction);
        }

        while (true) {
            sleep(1);

            $this->checkFinish();
        }
    }

    private function initProcess(string $path, $code, ?callable $callbackFunction): Process
    {
        $process = new Process(['php', $path, "--code=$code"]);
        $process->start($callbackFunction);

        $this->pullProcess[$process->getPid() . ':' . $path] = $process;

        return $process;
    }

    private function checkFinish()
    {
        if (empty($this->pullProcess))  return;

        foreach ($this->pullProcess as $nameProcess => $process) {
            if ($process instanceof Process && !$process->isRunning()) {

                (new \BoxberryListPoints\Libs\Logger('MultiProcessing'))
                    ->addLogInfo("Script #FINISHED: " . $nameProcess . ' ' . $process->getOutput() . "\n");

                unset($this->pullProcess[$nameProcess]);
            }
        }
    }
}