<?php

namespace BoxberryListPoints\Models;

class Areas extends AbstractModel
{
    protected ?int $id;
    protected ?string $Name;
    protected ?int $CountryCode;

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
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->Name;
    }

    /**
     * @param string|null $Name
     */
    public function setName(?string $Name)
    {
        $this->Name = $Name;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getCountryCode(): ?int
    {
        return $this->CountryCode;
    }

    /**
     * @param int|null $CountryCode
     */
    public function setCountryCode(?int $CountryCode)
    {
        $this->CountryCode = $CountryCode;
        return $this;
    }


}