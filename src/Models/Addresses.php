<?php

namespace BoxberryListPoints\Models;

class Addresses extends AbstractModel
{
    protected ?int $id;
    protected ?string $Street;
    protected ?string $House;
    protected ?string $Structure;
    protected ?string $Housing;
    protected ?string $Apartment;
    protected ?string $AddressFull;
    protected ?string $AddressReduce;
    protected ?string $TripDescription;


    public function __construct(?int $id = null)
    {
        $this->id = $id;
        parent::__construct($this->id);
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * @return string|null
     */
    public function getStreet(): ?string
    {
        return $this->Street;
    }

    /**
     * @param string|null $Street
     */
    public function setStreet(?string $Street)
    {
        $this->Street = $Street;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getHouse(): ?string
    {
        return $this->House;
    }

    /**
     * @param string|null $House
     */
    public function setHouse(?string $House)
    {
        $this->House = $House;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getStructure(): ?string
    {
        return $this->Structure;
    }

    /**
     * @param string|null $Structure
     */
    public function setStructure(?string $Structure)
    {
        $this->Structure = $Structure;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getHousing(): ?string
    {
        return $this->Housing;
    }

    /**
     * @param string|null $Housing
     */
    public function setHousing(?string $Housing)
    {
        $this->Housing = $Housing;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getApartment(): ?string
    {
        return $this->Apartment;
    }

    /**
     * @param string|null $Apartment
     */
    public function setApartment(?string $Apartment)
    {
        $this->Apartment = $Apartment;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddressFull(): ?string
    {
        return $this->AddressFull;
    }

    /**
     * @param string|null $AddressFull
     */
    public function setAddressFull(?string $AddressFull)
    {
        $this->AddressFull = $AddressFull;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddressReduce(): ?string
    {
        return $this->AddressReduce;
    }

    /**
     * @param string|null $AddressReduce
     */
    public function setAddressReduce(?string $AddressReduce)
    {
        $this->AddressReduce = $AddressReduce;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTripDescription(): ?string
    {
        return $this->TripDescription;
    }

    /**
     * @param string|null $TripDescription
     */
    public function setTripDescription(?string $TripDescription)
    {
        $this->TripDescription = $TripDescription;
        return $this;
    }
}