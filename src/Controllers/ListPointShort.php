<?php

namespace BoxberryListPoints\Controllers;

use BoxberryListPoints\Models\{
    DataBase,
    Addresses as AddressModel,
    Areas as AreaModel,
    Cities as CityModel,
    Metro as MetroModel,
    WorkShedule as WorkSheduleModel,
    GPS as GPSModel,
    Properties as PropertiesModel,
    ListPoints as ListPointModel,
    Photos as PhotoModel
};

class ListPointShort
{
    /**
     * @param string $city
     * @param string $street
     * @param string|null $house
     * @param string|null $structure
     * @param string|null $housing
     * @param string|null $apartment
     * @return array
     * @throws \Exception
     */
    public static function findPointShortByAddress(
        string $city,
        string $street,
        ?string $house = null,
        ?string $structure = null,
        ?string $housing = null,
        ?string $apartment = null
    ): array
    {
        $dataBase = new DataBase();

        $cityModel = new CityModel();
        $cityModel->initDataBase($dataBase);
        $cityModel->setName($city);
        $resultCityFind = $cityModel->find();
        if (empty($resultCityFind)) return [];


        $address = new AddressModel();
        $address->initDataBase($dataBase);
        $address->setCitiesId($cityModel->getId())
            ->setStreet($street);

        if ($house) $address->setHouse($house);
        if ($structure) $address->setStructure($structure);
        if ($housing) $address->setHousing($housing);
        if ($apartment) $address->setApartment($apartment);

        $results = $address->find();
        if (!empty($results))
            return static::findPointsShortByFieldId('setAddressId', $results, $dataBase);

        return [];
    }

    public static function findAllPointsShort(?array $Fields = null): array|bool
    {
        $PointModel = new ListPointModel();

        return $PointModel->findAll($Fields);
    }


    /**
     * @param string $code
     * @return bool|array
     * @throws \Exception
     */
    public static function findPointShortByCode(string $code): bool | array
    {
        $PointModel = new ListPointModel();

        return $PointModel
            ->setCode($code)
            ->find();
    }

    /**
     * @param int $id
     * @return \BoxberryListPoints\Models\ListPoints
     */
    public static function findPointShortById(int $id): \BoxberryListPoints\Models\ListPoints
    {
        $PointModel = new ListPointModel($id);
        return $PointModel;
    }

    /**
     * @param int $ZipCode
     * @return bool|array
     * @throws \Exception
     */
    public static function findPointShortByZipCode(int $ZipCode): bool|array
    {
        $PointModel = new ListPointModel();

        return $PointModel
            ->setZipCode($ZipCode)
            ->find();
    }

    /**
     * @param $city
     * @return array
     * @throws \Exception
     */
    public static function findPointShortByCityName($city): array
    {
        $dataBase = new DataBase();

        $cityModel = new CityModel();
        $cityModel->setName($city);
        $results = $cityModel->find();

        if (!empty($results))
            return static::findPointsShortByFieldId('setCityId', $results, $dataBase);

        return [];
    }

    /**
     * @param $settlement
     * @return array
     * @throws \Exception
     */
    public static function findPointShortBySettlement($settlement): array
    {
        $dataBase = new DataBase();

        $cityModel = new CityModel();
        $cityModel->initDataBase($dataBase);
        $cityModel->setSettlement($settlement);
        $results = $cityModel->find();

        if (!empty($results))
            return static::findPointsShortByFieldId('setCityId', $results, $dataBase);

        return [];
    }

    /**
     * @param float $latitude
     * @param float $longitude
     * @param int $radius
     * @return array
     */
    public static function findPointByGPS(float $latitude, float $longitude, int $radius): array
    {
        return [];
    }

    /**
     * @param string $fieldSetter
     * @param array $results
     * @param \BoxberryListPoints\Models\DataBase $dataBase
     * @return array
     * @throws \Exception
     */
    protected static function findPointsShortByFieldId(string $fieldSetter, array $results, DataBase $dataBase): array
    {
        $PointModel = new ListPointModel();
        if (!method_exists($PointModel, $fieldSetter))
            throw new \Exception('Переден некоректный метод');

        $list = [];
        foreach ($results as $resultName => $result) {
            $Point = clone $PointModel;
            $Point->initDataBase($dataBase);
            $resultPoint = $Point
                ->$fieldSetter($result->getId())
                ->find();
            unset($results[$resultName]);
            $list = array_merge($list, $resultPoint);
        }
        return  $list;
    }

}