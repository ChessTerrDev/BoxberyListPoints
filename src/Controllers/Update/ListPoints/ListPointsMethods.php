<?php

namespace BoxberryListPoints\Controllers\Update\ListPoints;

class ListPointsMethods extends AbstractPoints
{
    public function __construct($method)
    {
        parent::__construct($method);
    }

    public function loadFullListPoints(array $param = [])
    {
        $this->param = array_merge($this->param, $param);
        $this->loadListPoints($this->param);
        return $this;
    }

    public function loadCountryListPoints(int $countryCode, array $param = [])
    {
        $this->param = array_merge(
            $this->param,
            [
                'CountryCode' => $countryCode,
            ],
            $param);
        $this->loadListPoints($this->param);

        return $this;
    }

    public function loadCityListPoints(int $countryCode, string $cityCode, array $param = [])
    {
        $this->param = array_merge(
            $this->param,
            [
                'CountryCode' => $countryCode,
                'CityCode' => $cityCode
            ],
            $param);
        $this->loadListPoints($this->param);
        return $this;
    }
}