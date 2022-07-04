<?php

namespace BoxberryListPoints\Models;

class Photos extends AbstractModel
{
    protected int $id;
    protected string $PhotoLink;
    protected int $ListPoint_id;

    public function __construct(?int $id = null)
    {
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
    public function getPhotoLink(): string
    {
        return $this->PhotoLink;
    }

    /**
     * @param string $PhotoLink
     */
    public function setPhotoLink(string $PhotoLink): Photos
    {
        $this->PhotoLink = $PhotoLink;
        return $this;
    }

    /**
     * @return int
     */
    public function getListPointId(): int
    {
        return $this->ListPoint_id;
    }

    /**
     * @param int $ListPoint_id
     */
    public function setListPointId(int $ListPoint_id): Photos
    {
        $this->ListPoint_id = $ListPoint_id;
        return $this;
    }

}