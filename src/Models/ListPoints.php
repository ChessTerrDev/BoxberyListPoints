<?php

namespace BoxberryListPoints\Models;

class ListPoints extends AbstractModel
{
    protected ?int     $id;
    protected string   $Code;
    protected string   $TerminalCode;
    protected string   $Name;
    protected string   $Organization;
    protected int      $ZipCode;
    protected int      $CountryCode;
    protected string   $Phone;
    public Areas       $Area;
    public Cities      $City;
    public Addresses   $Address;
    public GPS         $GPS;
    public Properties  $Properties;
    public WorkShedule $WorkShedule;
    protected string   $UpdateDate;
    protected bool     $Active  = true;
    protected bool     $Deleted = false;

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
     * @param \BoxberryListPoints\Models\Areas $Area
     */
    public function setArea(Areas $Area): static
    {
        $this->Area = $Area;
        return $this;
    }

    /**
     * @param \BoxberryListPoints\Models\Cities $City
     */
    public function setCity(Cities $City): static
    {
        $this->City = $City;
        return $this;
    }

    /**
     * @param \BoxberryListPoints\Models\Addresses $Address
     */
    public function setAddress(Addresses $Address): static
    {
        $this->Address = $Address;
        return $this;
    }

    /**
     * @param \BoxberryListPoints\Models\GPS $GPS
     */
    public function setGPS(GPS $GPS): static
    {
        $this->GPS = $GPS;
        return $this;
    }

    /**
     * @param \BoxberryListPoints\Models\Properties $Properties
     */
    public function setProperties(Properties $Properties): static
    {
        $this->Properties = $Properties;
        return $this;
    }

    /**
     * @param \BoxberryListPoints\Models\WorkShedule $WorkShedule
     */
    public function setWorkShedule(WorkShedule $WorkShedule): static
    {
        $this->WorkShedule = $WorkShedule;
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

    /**
     * @param $value
     * @return mixed
     */
    public function getValueField($value, $field = null): mixed
    {
        $arrayModels = ['Area' => 'Areas', 'City' => 'Cities', 'Address' => 'Addresses', 'GPS' => 'GPS', 'Properties' => 'Properties', 'WorkShedule' => 'WorkShedule'];
        if (property_exists($this, $field) && isset($arrayModels[$field])) {
            $class = '\BoxberryListPoints\Models\\' .$arrayModels[$field];
            return new $class($value);
        }

        return $value;
    }


    /**
     * @return array|null
     * @throws \Exception
     */
    public function getPhotos(): ?array
    {
        if ($this->id) {
            $PhotosModel = new \BoxberryListPoints\Models\Photos();
            return $PhotosModel
                ->setListPointId($this->id)
                ->find();
        }
        return null;
    }

    /**
     *
     * @return array|null
     * @throws \Exception
     */
    public function getMetro(): ?array
    {
        if ($this->id) {
            $MetroModel = new \BoxberryListPoints\Models\Metro();
            return $MetroModel
                ->setListPointsId($this->id)
                ->find();
        }
        return null;
    }

    /**
     * Returns object parameters (which are not a model) and saves the states of child models
     * @return array
     */
    protected function getFieldsForSave(): array
    {
        $arrayModels = ['Area', 'City', 'Address', 'GPS', 'Properties', 'WorkShedule'];
        $params = parent::getFieldsForSave();

        foreach ($params as $paramName => $param)
            if (in_array($paramName, $arrayModels) && is_object($this->$paramName) && method_exists($this->$paramName, 'save')){
                $this->$paramName->save();
                unset($params[$paramName]);
            };

        return $params;
    }

    /**
     * Saves the entity's "deleted" status
     * @return bool
     * @throws \Exception
     */
    public function setDelete(): bool
    {
        $param = ['Deleted' => true, 'Active' => false];
        return $this
            ->initDataBase()
            ->updateEntryById($this->baseName(), $this->getId(), $param);
    }
}