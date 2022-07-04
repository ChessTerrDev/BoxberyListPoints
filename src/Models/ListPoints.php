<?php

namespace BoxberryListPoints\Models;

class ListPoints extends AbstractModel
{
    protected ?int $id;
    protected string $Code;
    protected string $TerminalCode;
    protected string $Name;
    protected string $Organization;
    protected int    $ZipCode;
    protected int    $CountryCode;
    protected int    $Area_id;
    protected int    $City_id;
    protected int    $Address_id;
    protected int    $GPS_id;
    protected int    $Property_id;
    protected string $Phone;
    protected int    $WorkShedule_id;
    protected string $UpdateDate;
    protected bool   $Active  = true;
    protected bool   $Deleted = false;

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
     * @param int|null $id
     */
    protected function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->Code;
    }

    /**
     * @param string $Code
     * @return ListPoints
     */
    public function setCode(string $Code): ListPoints
    {
        $this->Code = $Code;
        return $this;
    }

    /**
     * @return string
     */
    public function getTerminalCode(): string
    {
        return $this->TerminalCode;
    }

    /**
     * @param string $TerminalCode
     * @return ListPoints
     */
    public function setTerminalCode(string $TerminalCode): ListPoints
    {
        $this->TerminalCode = $TerminalCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->Name;
    }

    /**
     * @param string $Name
     * @return ListPoints
     */
    public function setName(string $Name): ListPoints
    {
        $this->Name = $Name;
        return $this;
    }

    /**
     * @return string
     */
    public function getOrganization(): string
    {
        return $this->Organization;
    }

    /**
     * @param string $Organization
     * @return ListPoints
     */
    public function setOrganization(string $Organization): ListPoints
    {
        $this->Organization = $Organization;
        return $this;
    }

    /**
     * @return int
     */
    public function getZipCode(): int
    {
        return $this->ZipCode;
    }

    /**
     * @param int $ZipCode
     * @return ListPoints
     */
    public function setZipCode(int $ZipCode): ListPoints
    {
        $this->ZipCode = $ZipCode;
        return $this;
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
     * @return ListPoints
     */
    public function setCountryCode(int $CountryCode): ListPoints
    {
        $this->CountryCode = $CountryCode;
        return $this;
    }

    /**
     * @return int
     */
    public function getAreaId(): int
    {
        return $this->Area_id;
    }

    /**
     * @param int $Area_id
     * @return ListPoints
     */
    public function setAreaId(int $Area_id): ListPoints
    {
        $this->Area_id = $Area_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getCityId(): int
    {
        return $this->City_id;
    }

    /**
     * @param int $City_id
     * @return ListPoints
     */
    public function setCityId(int $City_id): ListPoints
    {
        $this->City_id = $City_id;
        return $this;
    }


    /**
     * @return int
     */
    public function getAddressId(): int
    {
        return $this->Address_id;
    }

    /**
     * @param int $Address_id
     * @return ListPoints
     */
    public function setAddressId(int $Address_id): ListPoints
    {
        $this->Address_id = $Address_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getGPSId(): int
    {
        return $this->GPS_id;
    }

    /**
     * @param int $GPS_id
     * @return ListPoints
     */
    public function setGPSId(int $GPS_id): ListPoints
    {
        $this->GPS_id = $GPS_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getPropertyId(): int
    {
        return $this->Property_id;
    }

    /**
     * @param int $Property_id
     * @return ListPoints
     */
    public function setPropertyId(int $Property_id): ListPoints
    {
        $this->Property_id = $Property_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->Phone;
    }

    /**
     * @param string $Phone
     * @return ListPoints
     */
    public function setPhone(string $Phone): ListPoints
    {
        $this->Phone = $Phone;
        return $this;
    }

    /**
     * @return int
     */
    public function getWorkSheduleId(): int
    {
        return $this->WorkShedule_id;
    }

    /**
     * @param int $WorkShedule_id
     * @return ListPoints
     */
    public function setWorkSheduleId(int $WorkShedule_id): ListPoints
    {
        $this->WorkShedule_id = $WorkShedule_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getUpdateDate(): string
    {
        return $this->UpdateDate;
    }

    /**
     * @param string $UpdateDate
     * @return ListPoints
     */
    public function setUpdateDate(string $UpdateDate): ListPoints
    {
        $this->UpdateDate = $UpdateDate;
        return $this;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->Active;
    }

    /**
     * @param bool $Active
     * @return ListPoints
     */
    public function setActive(bool $Active): ListPoints
    {
        $this->Active = $Active;
        return $this;
    }

    /**
     * @return bool
     */
    public function isDeleted(): bool
    {
        return $this->Deleted;
    }

    /**
     * @param bool $Deleted
     * @return ListPoints
     */
    public function setDeleted(bool $Deleted): ListPoints
    {
        $this->Deleted = $Deleted;
        return $this;
    }
}