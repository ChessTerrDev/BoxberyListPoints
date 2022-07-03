<?php

namespace BoxberryListPoints\Libs;

use Symfony\Component\Process\Process;

class MultiProcessing
{
    private array $pullProcess = [];
    private string $scriptPath;
    private array $params;
    private int $sumOfProcesses = 50;
    private ?\Closure $finishCallbackFunction = null;
    private ?\Closure $startCallbackFunction  = null;


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

        while (true) {
            $this->initProcesses();

            sleep(1);

            if (empty($this->pullProcess))  {
                echo "Finished MultiProcessing \n";
                return;
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

            $this->initProcess($this->scriptPath, $param['Code']);

            unset($this->params[$key]);
        }
    }

    /**
     * starts the process
     * @param string $path
     * @param $code
     * @return \Symfony\Component\Process\Process
     */
    private function initProcess(string $path, $code): Process
    {
        $startCallbackFunction = $this->startCallbackFunction;

        $process = new Process(['php', $path, "--code=$code"]);
        $process->start($startCallbackFunction("--code=$code"));

        $this->pullProcess[$process->getPid() . ':' . $path] = $process;

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