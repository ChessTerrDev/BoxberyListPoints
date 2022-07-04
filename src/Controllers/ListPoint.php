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
    public function __construct()
    {

    }

    public function addPoint(array $pointDescription): ListPointModel
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
                ->setCountryCode((int)$pointDescription['CountryCode'])
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
                ->setAddressFull($pointDescription['Address']);
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
                ->setCountryCode((int)$pointDescription['CountryCode'])
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

    public function findPointShort()
    {

    }

    public function findPoint()
    {

    }
}