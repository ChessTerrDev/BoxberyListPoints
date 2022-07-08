<?php

namespace BoxberryListPoints\Libs;

use Symfony\Component\Process\Process;

class MultiProcessing
{
    private array $pullProcess = [];
    private string $scriptPath;
    private array $params;
    private int $sumOfProcesses = 10;
    private ?\Closure $finishCallbackFunction = null;
    private ?\Closure $startCallbackFunction  = null;
    private array $statistics = [
        'startingNumberEntries' => 0,
        'processesStarted' => 0,
        'completedProcesses' => 0,
        'processStartupCycles' => 0,
        'scriptExecutionTime' => 0
    ];


    /**
     * @param string $scriptPath: the path to the php script that will be run
     * @param array $params: the list of parameters that will be applied when running the script, how many elements are in the array, how much the script will be run
     */
    public function __construct(string $scriptPath, array $params)
    {
        $this->scriptPath = $scriptPath;
        $this->params = $params;
    }

    /**
     * Starts the creation of processes
     * @return mixed
     */
    public function run()
    {
        echo "Starting MultiProcessing \n";
        $this->statistics['startingNumberEntries'] = count($this->params);
        $this->statistics['scriptExecutionTime'] = microtime(true);

        while (true) {
            $this->initProcesses();
            $this->statistics['processStartupCycles'] += 1;
            sleep(1);

            if (empty($this->pullProcess))  {
                echo "Finished MultiProcessing \n";
                $this->statistics['scriptExecutionTime'] = microtime(true) - $this->statistics['scriptExecutionTime'];
                return $this->statistics;
            }

            $this->checkFinish();
        }
    }

    /**
     * Starts the specified number of processes
     * @return void
     */
    private function initProcesses(): void
    {
        foreach ($this->params as $key => $param) {
            if (count($this->pullProcess) >= $this->sumOfProcesses) return;

            $this->initProcess($this->scriptPath, $param);

            unset($this->params[$key]);
        }
    }

    /**
     * starts the process
     * @param string $path
     * @param $code
     * @return \Symfony\Component\Process\Process
     */
    private function initProcess(string $path, $param): Process
    {
        $startCallbackFunction = $this->startCallbackFunction;
        $command = ['php', $path];
        if (is_array($param)) foreach ($param as $key => $val) {
            $command[] = '--' . $key . '="' .$val . '"';
        }

        $process = new Process($command);
        $process->start($startCallbackFunction("--code=" . $param['Code']));

        $this->pullProcess[$process->getPid() . ':' . $path] = $process;

        $this->statistics['processesStarted'] += 1;
        return $process;
    }

    /**
     * @return void
     */
    private function checkFinish(): void
    {
        foreach ($this->pullProcess as $nameProcess => $process) {
            if ($process instanceof Process && !$process->isRunning()) {

                $finishCallbackFunction = $this->finishCallbackFunction;
                $finishCallbackFunction($nameProcess . " : " . $process->getOutput());

                $this->statistics['completedProcesses'] += 1;
                unset($this->pullProcess[$nameProcess]);
            }
        }
    }

    /**
     * @param \Closure|null $finishCallbackFunction finished init Process Callback Function
     */
    public function setFinishCallbackFunction(?\Closure $finishCallbackFunction)
    {
        $this->finishCallbackFunction = $finishCallbackFunction;
        return $this;
    }

    /**
     * @param \Closure|null $startCallbackFunction start init Process Callback Function
     */
    public function setStartCallbackFunction(?\Closure $startCallbackFunction)
    {
        $this->startCallbackFunction = $startCallbackFunction;
        return $this;
    }

    /**
     * @param int $sumOfProcesses number of simultaneously running processes
     */
    public function setSumOfProcesses(int $sumOfProcesses)
    {
        $this->sumOfProcesses = $sumOfProcesses;
        return $this;
    }
}