<?php

namespace BoxberryListPoints\Controllers;

use BoxberryListPoints\Models\Address;


class Addresses
{
    private string $street;
    private string $house;
    private string $structure;
    private string $housing;
    private string $apartment;
    private string $addressFull;
    private string $addressReduce;
    private string $tripDescription;

    public function save()
    {

    }

    /**
     * @param string $street
     */
    public function setStreet(string $street): void
    {
        $this->street = $street;
    }

    /**
     * @param string $house
     */
    public function setHouse(string $house): void
    {
        $this->house = $house;
    }

    /**
     * @param string $structure
     */
    public function setStructure(string $structure): void
    {
        $this->structure = $structure;
    }

    /**
     * @param string $housing
     */
    public function setHousing(string $housing): void
    {
        $this->housing = $housing;
    }

    /**
     * @param string $apartment
     */
    public function setApartment(string $apartment): void
    {
        $this->apartment = $apartment;
    }

    /**
     * @param string $addressFull
     */
    public function setAddressFull(string $addressFull): void
    {
        $this->addressFull = $addressFull;
    }

    /**
     * @param string $addressReduce
     */
    public function setAddressReduce(string $addressReduce): void
    {
        $this->addressReduce = $addressReduce;
    }

    /**
     * @param string $tripDescription
     */
    public function setTripDescription(string $tripDescription): void
    {
        $this->tripDescription = $tripDescription;
    }

}