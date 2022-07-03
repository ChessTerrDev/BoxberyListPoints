<?php

namespace BoxberryListPoints\Models;

class Countries extends AbstractModel
{
    protected int $CountryCode;
    protected string $CountryName;

    public function __construct(?int $id = null)
    {
        parent::__construct($id);
    }

    /**
     * @return int
     */
    public function getCountryCode(): int
    {
        return $this->CountryCode;
    }

    /**
     * @param int $CountryCode
     */
    public function setCountryCode(int $CountryCode): static
    {
        $this->CountryCode = $CountryCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountryName(): string
    {
        return $this->CountryName;
    }

    /**
     * @param string $CountryName
     */
    public function setCountryName(string $CountryName): static
    {
        $this->CountryName = $CountryName;
        return $this;
    }
}