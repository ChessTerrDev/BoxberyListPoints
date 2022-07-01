<?php

namespace BoxberryListPoints\Controllers\Update;

use BoxberryListPoints\Controllers\Update\ListPoints\PointsDescription;

final class FullUpdate
{
    private string $jsonPathListPoints;

    public function __construct()
    {
        $listPoints = new ListPoints\ListPoints();
        $this->jsonPathListPoints = $listPoints
            ->loadFullListPoints()
            ->toJsonFile();
    }

    private function jsonFileIterator($file)
    {
        foreach (json_decode(file_get_contents($file), true) as $item) {
            yield $item;
        }
    }

    public function genIter()
    {
        $result = [];
        foreach ($this->jsonFileIterator($this->jsonPathListPoints) as $point) {
            //$result[] = (new PointsDescription($point['Code']))->loadPointsDescription()->toObject();
            $result[] = $point['Code'];
        }
        return $result;
    }

    public function arrIter()
    {
        $result = [];
        foreach (json_decode(file_get_contents($this->jsonPathListPoints), true) as $point) {
            $result[] = $point['Code'];
        }
        return $result;
    }

    // Получаем массив всех ПВЗ РФ или ссылку на json файл в котором сохранена информация всех ПВЗ РФ

    // При помощи генератора проходим по всем ПВЗ json файла или массива

    // На каждой итерации
        // получать подробную информацию ПВЗ
        // Записывать в базу если такой записи еще нет или дата полученной записи позже записи в БД
        // Записывать в лог все удачно сохраненные записи
        // Записывать в лог ошибки при обновлении
        //
    //
}