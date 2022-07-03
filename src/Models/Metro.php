<?php

namespace BoxberryListPoints\Models;

class Metro extends AbstractModel
{
    protected ?int $id;
    protected ?string $MetroName;
    protected int $City_id;

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
     * @return string
     */
    public function getMetroName(): string
    {
        return $this->MetroName;
    }

    /**
     * @param string $MetroName
     */
    public function setMetroName(string $MetroName)
    {
        $this->MetroName = $MetroName;
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
     */
    public function setCityId(int $City_id)
    {
        $this->City_id = $City_id;
        return $this;
    }

}