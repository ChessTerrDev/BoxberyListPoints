<?php

namespace BoxberryListPoints\Controllers\Update\ListPoints;

use BoxberryListPoints\Configuration\Constants;

abstract class AbstractPoints
{
    protected string $method;
    protected array $param;
    protected string $jsonListPoints;

    public function __construct($method)
    {
        $this->method = $method;
        $this->param = [
            'method' => $this->method
        ];
    }


    protected function loadListPoints($param, ?string $saveInFilePath = null)
    {
        $client = new BoxberryClient();
        return $this->jsonListPoints = $client->getData($param, $saveInFilePath);
    }


    public function toArray()
    {
        return json_decode($this->jsonListPoints, true);
    }

    public function toObject()
    {
        return json_decode($this->jsonListPoints, false);
    }

    public function toJson()
    {
        return$this->jsonListPoints;
    }

    public function toJsonFile(?string $filePath = null)
    {
        if (Constants::TMP_PATH)  $file = Constants::TMP_PATH . $this->method .'.json';
        if ($filePath) $file = $filePath;

        if (empty($file) || !file_exists($file))
           throw new \Exception('Не указан путь сохранения json файла или такого файла не существует!');

        file_put_contents($file, $this->jsonListPoints);
        unset($this->jsonListPoints);

        return $file;
    }
}