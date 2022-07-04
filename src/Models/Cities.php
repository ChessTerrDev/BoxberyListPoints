<?php

namespace BoxberryListPoints\Models;

class Cities extends AbstractModel
{
    protected ?int $id;
    protected string $Name;
    protected string $Settlement;
    protected int $Area_id;

    public function __construct(?int $id = null)
    {
        $this->id = $id;
        parent::__construct($id);
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
    public function getName(): string
    {
        return $this->Name;
    }

    /**
     * @param string $Name
     */
    public function setName(string $Name)
    {
        $this->Name = $Name;
        return $this;
    }

    /**
     * @return string
     */
    public function getSettlement(): string
    {
        return $this->Settlement;
    }

    /**
     * @param string $Settlement
     */
    public function setSettlement(string $Settlement)
    {
        $this->Settlement = $Settlement;
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
     */
    public function setAreaId(int $Area_id)
    {
        $this->Area_id = $Area_id;
        return $this;
    }

}