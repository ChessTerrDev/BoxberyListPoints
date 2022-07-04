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

class ListPoint
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
    public static function findPointByAddress(
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
        $cityModel
            ->setDataBase($dataBase)
            ->setName($city);
        $resultCityFind = $cityModel->find();
        if (empty($resultCityFind)) return [];


        $address = new AddressModel();
        $address
            ->setDataBase($dataBase)
            ->setCitiesId($cityModel->getId())
            ->setStreet($street);

        if ($house) $address->setHouse($house);
        if ($structure) $address->setStructure($structure);
        if ($housing) $address->setHousing($housing);
        if ($apartment) $address->setApartment($apartment);

        $results = $address->find();
        if (!empty($results))
            return static::findPointsByFieldId('setAddressId', $results, $dataBase);

        return [];
    }


    /**
     * @param string $code
     * @return bool|array
     * @throws \Exception
     */
    public static function findPointByCode(string $code): bool | array
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
    public static function findPointById(int $id): \BoxberryListPoints\Models\ListPoints
    {
        $PointModel = new ListPointModel($id);
        return $PointModel;
    }

    /**
     * @param int $ZipCode
     * @return bool|array
     * @throws \Exception
     */
    public static function findPointByZipCode(int $ZipCode): bool|array
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
    public static function findPointByCityName($city): array
    {
        $dataBase = new DataBase();

        $cityModel = new CityModel();
        $cityModel
            ->setName($city);
        $results = $cityModel->find();

        if (!empty($results))
            return static::findPointsByFieldId('setCityId', $results, $dataBase);

        return [];
    }

    /**
     * @param $settlement
     * @return array
     * @throws \Exception
     */
    public static function findPointBySettlement($settlement): array
    {
        $dataBase = new DataBase();

        $cityModel = new CityModel();
        $cityModel
            ->setDataBase($dataBase)
            ->setSettlement($settlement);
        $results = $cityModel->find();

        if (!empty($results))
            return static::findPointsByFieldId('setCityId', $results, $dataBase);

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
    protected static function findPointsByFieldId(string $fieldSetter, array $results, DataBase $dataBase): array
    {
        $PointModel = new ListPointModel();
        if (!method_exists($PointModel, $fieldSetter))
            throw new \Exception('Переден некоректный метод');

        $list = [];
        foreach ($results as $resultName => $result) {
            $Point = clone $PointModel;
            $Point->setDataBase($dataBase);
            $resultPoint = $Point
                ->$fieldSetter($result->getId())
                ->find();
            unset($results[$resultName]);
            $list = array_merge($list, $resultPoint);
        }
        return  $list;
    }

    /**
     * @param array $pointDescription
     * @return \BoxberryListPoints\Models\ListPoints
     * @throws \Exception
     */
    public static function addPoint(array $pointDescription): ListPointModel
    {
        $dataBase = new DataBase();
        $dataBase->beginTransaction();

        try {
            $countries = new \BoxberryListPoints\Models\Countries();
            $countries
                ->setCountryCode((int)$pointDescription['CountryCode'])
                ->setCountryName($pointDescription['Country']);
            $resultCountriesFind = $countries->find();
            $countries = !empty($resultCountriesFind) ? $resultCountriesFind[0] : $countries->addEntryInDataBase(null, null);

            $area = new AreaModel();
            $area
                ->setDataBase($dataBase)
                ->setCountryCode($countries->getCountryCode())
                ->setName($pointDescription['Area']);
            $resultAreaFind = $area->find();
            $area = !empty($resultAreaFind) ? $resultAreaFind[0] : $area->addEntryInDataBase();


            $city = new CityModel();
            $city
                ->setDataBase($dataBase)
                ->setName($pointDescription['CityName'])
                ->setSettlement($pointDescription['Settlement'])
                ->setAreaId($area->getId());
            $resultCityFind = $city->find();
            $city = !empty($resultCityFind) ? $resultCityFind[0] : $city->addEntryInDataBase();

            $address = new AddressModel();
            $address
                ->setDataBase($dataBase)
                ->setFields($pointDescription)
                ->setAddressFull($pointDescription['Address'])
                ->setCitiesId($city->getId());
            $address->addEntryInDataBase();

            $workShedule = new WorkSheduleModel();
            $workShedule
                ->setDataBase($dataBase)
                ->setFields($pointDescription)
                ->setScheduleJSON($pointDescription['schedule'])
                ->setShortWorkShedule($pointDescription['WorkShedule']);
            $workShedule->addEntryInDataBase();

            if (empty($pointDescription['GPS'])) $pointDescription['GPS'] = '0, 0';
            list($latitude, $longitude) = explode(',', $pointDescription['GPS']);
            $GPS = new GPSModel();
            $GPS
                ->setDataBase($dataBase)
                ->setLatitude((float)$latitude ?? 0)
                ->setLongitude((float)$longitude ?? 0);
            $GPS->addEntryInDataBase();

            $properties = new PropertiesModel();
            $properties
                ->setDataBase($dataBase)
                ->setFields($pointDescription)
                ->setNalKD($pointDescription['CourierDelivery']);
            $properties->addEntryInDataBase();


            $Point = new ListPointModel();
            $Point
                ->setDataBase($dataBase)
                ->setCode($pointDescription['extraCode'])
                ->setTerminalCode($pointDescription['TerminalCode'])
                ->setName($pointDescription['Name'])
                ->setOrganization($pointDescription['Organization'])
                ->setZipCode($pointDescription['ZipCode'])
                ->setCountryCode($countries->getCountryCode())
                ->setAreaId($area->getId())
                ->setCityId($city->getId())
                ->setGPSId($GPS->getId())
                ->setAddressId($address->getId())
                ->setPropertyId($properties->getId())
                ->setPhone($pointDescription['Phone'])
                ->setWorkSheduleId($workShedule->getId())
                ->setUpdateDate(date("Y-m-d"))
                ->setActive(true)
                ->setDeleted(false);

            $Point->addEntryInDataBase();

            if (!empty($pointDescription['Metro'])) {
                $metro = new MetroModel();
                $metro
                    ->setDataBase($dataBase)
                    ->setMetroName($pointDescription['Metro'])
                    ->setCityId($city->getId())
                    ->setListPointsId($Point->getId());
                $metro->addEntryInDataBase();
            }

            if (!empty($pointDescription['photoLinks'])) {
                foreach ($pointDescription['photoLinks'] as $photoLink) {
                    $photo = new PhotoModel();
                    $photo
                        ->setDataBase($dataBase)
                        ->setPhotoLink((string)$photoLink)
                        ->setListPointId($Point->getId());
                    $photo->addEntryInDataBase();
                }
            }

        } catch (\Exception $e) {
            $dataBase->rollback();
            throw new \Exception('Error added entry in database!' . $e);
        }

        $dataBase->commit();

        return $Point;
    }



}