<?php

namespace BoxberryListPoints\Models;

class Properties extends AbstractModel
{
    protected ?int $id;
    protected ?bool  $ForeignOnlineStoresOnly = null;
    protected ?bool  $PrepaidOrdersOnly = null;
    protected ?bool  $Acquiring = null;
    protected ?bool  $DigitalSignature = null;
    protected ?int   $TypeOfOffice = null;
    protected ?bool  $CourierDelivery = null;
    protected ?bool  $Reception = null;
    protected ?bool  $ReceptionLaP = null;
    protected ?bool  $DeliveryLaP = null;
    protected ?float $LoadLimit = null;
    protected ?float $VolumeLimit = null;
    protected ?bool  $EnablePartialDelivery = null;
    protected ?bool  $EnableFitting = null;
    protected ?int   $fittingType = null;
    protected ?bool  $NalKD = null;
    protected ?int   $TransType = null;
    protected ?bool  $InterRefunds = null;
    protected ?bool  $ExpressReception = null;
    protected ?bool  $Terminal = null;
    protected ?bool  $IssuanceBoxberry = null;

    public function __construct(?int $id = null)
    {
        $this->id = $id;
        parent::__construct($this->id);
    }

    /**
     * @param $value
     * @return string|null
     */
    public function getValueField($value): mixed
    {
        return $value;
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
     * @return bool|null
     */
    public function getForeignOnlineStoresOnly(): ?bool
    {
        return $this->ForeignOnlineStoresOnly;
    }

    /**
     * @param bool|null $ForeignOnlineStoresOnly
     * @return Properties
     */
    public function setForeignOnlineStoresOnly(?bool $ForeignOnlineStoresOnly): Properties
    {
        $this->ForeignOnlineStoresOnly = $ForeignOnlineStoresOnly;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getPrepaidOrdersOnly(): ?bool
    {
        return $this->PrepaidOrdersOnly;
    }

    /**
     * @param bool|null $PrepaidOrdersOnly
     * @return Properties
     */
    public function setPrepaidOrdersOnly(?bool $PrepaidOrdersOnly): Properties
    {
        $this->PrepaidOrdersOnly = $PrepaidOrdersOnly;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getAcquiring(): ?bool
    {
        return $this->Acquiring;
    }

    /**
     * @param bool|null $Acquiring
     * @return Properties
     */
    public function setAcquiring(?bool $Acquiring): Properties
    {
        $this->Acquiring = $Acquiring;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getDigitalSignature(): ?bool
    {
        return $this->DigitalSignature;
    }

    /**
     * @param bool|null $DigitalSignature
     * @return Properties
     */
    public function setDigitalSignature(?bool $DigitalSignature): Properties
    {
        $this->DigitalSignature = $DigitalSignature;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getTypeOfOffice(): ?int
    {
        return $this->TypeOfOffice;
    }

    /**
     * @param int|null $TypeOfOffice
     * @return Properties
     */
    public function setTypeOfOffice(?int $TypeOfOffice): Properties
    {
        $this->TypeOfOffice = $TypeOfOffice;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getCourierDelivery(): ?bool
    {
        return $this->CourierDelivery;
    }

    /**
     * @param bool|null $CourierDelivery
     * @return Properties
     */
    public function setCourierDelivery(?bool $CourierDelivery): Properties
    {
        $this->CourierDelivery = $CourierDelivery;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getReception(): ?bool
    {
        return $this->Reception;
    }

    /**
     * @param bool|null $Reception
     * @return Properties
     */
    public function setReception(?bool $Reception): Properties
    {
        $this->Reception = $Reception;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getReceptionLaP(): ?bool
    {
        return $this->ReceptionLaP;
    }

    /**
     * @param bool|null $ReceptionLaP
     * @return Properties
     */
    public function setReceptionLaP(?bool $ReceptionLaP): Properties
    {
        $this->ReceptionLaP = $ReceptionLaP;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getDeliveryLaP(): ?bool
    {
        return $this->DeliveryLaP;
    }

    /**
     * @param bool|null $DeliveryLaP
     * @return Properties
     */
    public function setDeliveryLaP(?bool $DeliveryLaP): Properties
    {
        $this->DeliveryLaP = $DeliveryLaP;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getLoadLimit(): ?float
    {
        return $this->LoadLimit;
    }

    /**
     * @param float|null $LoadLimit
     * @return Properties
     */
    public function setLoadLimit(?float $LoadLimit): Properties
    {
        $this->LoadLimit = $LoadLimit;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getVolumeLimit(): ?float
    {
        return $this->VolumeLimit;
    }

    /**
     * @param float|null $VolumeLimit
     * @return Properties
     */
    public function setVolumeLimit(?float $VolumeLimit): Properties
    {
        $this->VolumeLimit = $VolumeLimit;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getEnablePartialDelivery(): ?bool
    {
        return $this->EnablePartialDelivery;
    }

    /**
     * @param bool|null $EnablePartialDelivery
     * @return Properties
     */
    public function setEnablePartialDelivery(?bool $EnablePartialDelivery): Properties
    {
        $this->EnablePartialDelivery = $EnablePartialDelivery;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getEnableFitting(): ?bool
    {
        return $this->EnableFitting;
    }

    /**
     * @param bool|null $EnableFitting
     * @return Properties
     */
    public function setEnableFitting(?bool $EnableFitting): Properties
    {
        $this->EnableFitting = $EnableFitting;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getFittingType(): ?int
    {
        return $this->fittingType;
    }

    /**
     * @param int|null $fittingType
     * @return Properties
     */
    public function setFittingType(?int $fittingType): Properties
    {
        $this->fittingType = $fittingType;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getNalKD(): ?bool
    {
        return $this->NalKD;
    }

    /**
     * @param bool|null $NalKD
     * @return Properties
     */
    public function setNalKD(?bool $NalKD): Properties
    {
        $this->NalKD = $NalKD;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getTransType(): ?int
    {
        return $this->TransType;
    }

    /**
     * @param int|null $TransType
     * @return Properties
     */
    public function setTransType(?int $TransType): Properties
    {
        $this->TransType = $TransType;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getInterRefunds(): ?bool
    {
        return $this->InterRefunds;
    }

    /**
     * @param bool|null $InterRefunds
     * @return Properties
     */
    public function setInterRefunds(?bool $InterRefunds): Properties
    {
        $this->InterRefunds = $InterRefunds;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getExpressReception(): ?bool
    {
        return $this->ExpressReception;
    }

    /**
     * @param bool|null $ExpressReception
     * @return Properties
     */
    public function setExpressReception(?bool $ExpressReception): Properties
    {
        $this->ExpressReception = $ExpressReception;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getTerminal(): ?bool
    {
        return $this->Terminal;
    }

    /**
     * @param bool|null $Terminal
     * @return Properties
     */
    public function setTerminal(?bool $Terminal): Properties
    {
        $this->Terminal = $Terminal;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIssuanceBoxberry(): ?bool
    {
        return $this->IssuanceBoxberry;
    }

    /**
     * @param bool|null $IssuanceBoxberry
     * @return Properties
     */
    public function setIssuanceBoxberry(?bool $IssuanceBoxberry): Properties
    {
        $this->IssuanceBoxberry = $IssuanceBoxberry;
        return $this;
    }
}