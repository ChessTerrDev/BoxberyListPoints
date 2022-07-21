<?php

namespace BoxberryListPoints\Controllers;

use BoxberryListPoints\DataBase\{Connection, DataBase};
use BoxberryListPoints\Models\{
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
        $connection = new Connection();
        $dataBase = new DataBase($connection->connect());

        $cityModel = new CityModel();
        $cityModel->initDataBase($dataBase);
        $cityModel->setName($city);
        $resultCityFind = $cityModel->find();
        if (empty($resultCityFind)) return [];


        $address = new AddressModel();
        $address->initDataBase($dataBase);
        $address->setCitiesId($resultCityFind[0]->getId())
            ->setStreet($street);

        if ($house) $address->setHouse($house);
        if ($structure) $address->setStructure($structure);
        if ($housing) $address->setHousing($housing);
        if ($apartment) $address->setApartment($apartment);

        $results = $address->find();
        $list = [];
        if (!empty($results)) {
            $PointModel = new ListPointModel();
            $PointModel->initDataBase($dataBase);

            foreach ($results as $resultName => $result) {
                $PointModel->setAddress($result);
                $resultPoint = $PointModel->find();
                unset($results[$resultName]);
                $list = array_merge($list, $resultPoint);
            }
        }

        return $list;
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
        $connection = new Connection();
        $dataBase = new DataBase($connection->connect());

        $cityModel = new CityModel();
        $cityModel->initDataBase($dataBase);
        $cityModel->setName($city);
        $result = self::extracted($cityModel, $dataBase);

        return $result;
    }

    /**
     * @param $settlement
     * @return array
     * @throws \Exception
     */
    public static function findPointShortBySettlement($settlement): array
    {
        $connection = new Connection();
        $dataBase = new DataBase($connection->connect());

        $cityModel = new CityModel();
        $cityModel->initDataBase($dataBase);
        $cityModel->setSettlement($settlement);
        $result = self::extracted($cityModel, $dataBase);

        return $result;
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
     * @param \BoxberryListPoints\Models\Cities $cityModel
     * @return array|bool
     * @throws \Exception
     */
    private static function extracted(CityModel $cityModel, $dataBase): array|bool
    {
        $results = $cityModel->find();

        if (empty($results)) return [];
        if (count($results) == 1) {
            $PointModel = new ListPointModel();
            $PointModel->initDataBase($dataBase);
            $PointModel->setCity($results[0]);
            $list = $PointModel->find();
        } else {
            $PointModel = new ListPointModel();
            $PointModel->initDataBase($dataBase);
            $list = [];
            foreach ($results as $resultName => $result) {
                $PointModel->setCity($result);
                $resultPoint = $PointModel->find();
                unset($results[$resultName]);
                $list = array_merge($list, $resultPoint);
            }
        }
        return $list;
    }


}