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
     * @param string $code
     * @return \BoxberryListPoints\Models\ListPoints|bool
     * @throws \Exception
     */
    public static function findPointByCode(string $code): ListPointModel | bool
    {
        $PointModel = new ListPointModel();
        $listPoints = $PointModel
            ->setCode($code)
            ->find();

        return $listPoints[0] ?? false;
    }

    /**
     * @param array $pointDescription
     * @return \BoxberryListPoints\Models\ListPoints
     * @throws \Exception
     */
    public static function addPoint(array $pointDescription): ListPointModel
    {
        $Point = static::findPointByCode($pointDescription['extraCode']);
        if ($Point) {
            $result = static::updatePoint($Point, $pointDescription);
            if (!$result)
                throw new \Exception('Error updatePoint');
            return $result;
        }

        $dataBase = new DataBase();
        $dataBase->beginTransaction();

        try {
            $countries = new \BoxberryListPoints\Models\Countries();
            $countries
                ->setCountryCode((int)$pointDescription['CountryCode'])
                ->setCountryName($pointDescription['Country']);
            $resultCountriesFind = $countries->find();
            !empty($resultCountriesFind) ? $countries = $resultCountriesFind[0] : $countries->addEntry(null, null);

            $area = new AreaModel();
            $area
                ->initDataBase($dataBase);
            $area
                ->setCountryCode($countries->getCountryCode())
                ->setName($pointDescription['Area']);
            $resultAreaFind = $area->find();
            $area = !empty($resultAreaFind) ? $resultAreaFind[0] : $area->addEntry();


            $city = new CityModel();
            $city
                ->initDataBase($dataBase);
            $city
                ->setName($pointDescription['CityName'])
                ->setSettlement($pointDescription['Settlement'])
                ->setAreaId($area->getId());
            $resultCityFind = $city->find();
            $city = !empty($resultCityFind) ? $resultCityFind[0] : $city->addEntry();

            $address = new AddressModel();
            $address
                ->initDataBase($dataBase);
            $address
                ->setFields($pointDescription)
                ->setAddressFull($pointDescription['Address'])
                ->setCitiesId($city->getId());
            $address->addEntry();

            if (empty($pointDescription['GPS'])) $pointDescription['GPS'] = '0, 0';
            list($latitude, $longitude) = explode(',', $pointDescription['GPS']);
            $GPS = new GPSModel();
            $GPS
                ->initDataBase($dataBase);
            $GPS
                ->setLatitude((float)$latitude ?? 0)
                ->setLongitude((float)$longitude ?? 0);
            $GPS->addEntry();

            $Properties = new PropertiesModel();
            $Properties->initDataBase($dataBase);
            $Properties
                ->setFields($pointDescription)
                ->setNalKD($pointDescription['CourierDelivery'])
                ->addEntry();
            $WorkShedule = new WorkSheduleModel();
            $WorkShedule->initDataBase($dataBase);
            $WorkShedule
                ->setFields($pointDescription)
                ->setScheduleJSON($pointDescription['schedule'])
                ->setShortWorkShedule($pointDescription['WorkShedule'])
                ->addEntry();

            $Point = new ListPointModel();
            $Point->initDataBase($dataBase);
            $Point
                ->setCode($pointDescription['extraCode'])
                ->setTerminalCode($pointDescription['TerminalCode'])
                ->setName($pointDescription['Name'])
                ->setOrganization($pointDescription['Organization'])
                ->setZipCode($pointDescription['ZipCode'])
                ->setCountryCode($countries->getCountryCode())
                ->setPhone($pointDescription['Phone'])
                ->setArea($area)
                ->setCity($city)
                ->setGPS($GPS)
                ->setAddress($address)
                ->setProperties($Properties)
                ->setWorkShedule($WorkShedule)
                ->setUpdateDate($pointDescription['UpdateDate'])
                ->setActive(true)
                ->setDeleted(false);

            $Point->addEntry();

            if (!empty($pointDescription['Metro'])) {
                $metro = new MetroModel();
                $metro
                    ->initDataBase($dataBase);
                $metro
                    ->setMetroName($pointDescription['Metro'])
                    ->setCityId($city->getId())
                    ->setListPointsId($Point->getId());
                $metro->addEntry();
            }

            if (!empty($pointDescription['photoLinks'])) {
                foreach ($pointDescription['photoLinks'] as $photoLink) {
                    $photo = new PhotoModel();
                    $photo
                        ->initDataBase($dataBase);
                    $photo
                        ->setPhotoLink((string)$photoLink)
                        ->setListPointId($Point->getId());
                    $photo->addEntry();
                }
            }

        } catch (\Exception $e) {
            $dataBase->rollback();
            throw new \Exception('Error added entry in database!' . $e);
        }

        $dataBase->commit();

        return $Point;
    }

    /**
     * @param \BoxberryListPoints\Models\ListPoints $Point
     * @param array $pointDescription
     * @return bool|\BoxberryListPoints\Models\ListPoints
     * @throws \Exception
     */
    public static function updatePoint(ListPointModel $Point, array $pointDescription): bool|ListPointModel
    {
        $dataBase = new DataBase();
        $dataBase->beginTransaction();

        try {
            $countries = new \BoxberryListPoints\Models\Countries();
            $countries
                ->setCountryCode((int)$pointDescription['CountryCode'])
                ->setCountryName($pointDescription['Country']);
            $resultCountriesFind = $countries->find();
            !empty($resultCountriesFind) ? $countries = $resultCountriesFind[0] : $countries->addEntry(null, null);

            $Point->initDataBase($dataBase);
            $Point
                ->setTerminalCode($pointDescription['TerminalCode'])
                ->setName($pointDescription['Name'])
                ->setOrganization($pointDescription['Organization'])
                ->setZipCode($pointDescription['ZipCode'])
                ->setCountryCode($countries->getCountryCode())
                ->setPhone($pointDescription['Phone']);
            $Point->Area
                ->setCountryCode($countries->getCountryCode())
                ->setName($pointDescription['Area']);
            $Point->City
                ->setName($pointDescription['CityName'])
                ->setSettlement($pointDescription['Settlement']);
            $Point
                ->Address
                ->setFields($pointDescription)
                ->setAddressFull($pointDescription['Address']);
            $Point
                ->Properties
                ->setFields($pointDescription)
                ->setNalKD($pointDescription['CourierDelivery']);
            $Point
                ->WorkShedule
                ->setFields($pointDescription)
                ->setScheduleJSON($pointDescription['schedule'])
                ->setShortWorkShedule($pointDescription['WorkShedule']);
            $Point
                ->setUpdateDate($pointDescription['UpdateDate'])
                ->setActive(true)
                ->setDeleted(false);


            if (empty($pointDescription['GPS'])) $pointDescription['GPS'] = '0, 0';
            list($latitude, $longitude) = explode(',', $pointDescription['GPS']);
            $Point->GPS
                ->setLatitude((float)$latitude ?? 0)
                ->setLongitude((float)$longitude ?? 0);

            $saveResult = $Point->save();

        } catch (\Exception $e) {
            $dataBase->rollback();
            throw new \Exception('Error added entry in database!' . $e);
        }

        $dataBase->commit();

        return $saveResult ? $Point : false;
    }


}