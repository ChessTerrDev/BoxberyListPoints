<?php

namespace BoxberryListPoints\Models;

class WorkShedule extends AbstractModel
{
    protected ?int $id;
    protected ?string $ShortWorkShedule;
    protected ?string $WorkMoBegin;
    protected ?string $WorkMoEnd;
    protected ?string $WorkTuBegin;
    protected ?string $WorkTuEnd;
    protected ?string $WorkWeBegin;
    protected ?string $WorkWeEnd;
    protected ?string $WorkThBegin;
    protected ?string $WorkThEnd;
    protected ?string $WorkFrBegin;
    protected ?string $WorkFrEnd;
    protected ?string $WorkSaBegin;
    protected ?string $WorkSaEnd;
    protected ?string $WorkSuBegin;
    protected ?string $WorkSuEnd;
    protected ?string $LunchMoBegin;
    protected ?string $LunchMoEnd;
    protected ?string $LunchTuBegin;
    protected ?string $LunchTuEnd;
    protected ?string $LunchWeBegin;
    protected ?string $LunchWeEnd;
    protected ?string $LunchThBegin;
    protected ?string $LunchThEnd;
    protected ?string $LunchFrBegin;
    protected ?string $LunchFrEnd;
    protected ?string $LunchSaBegin;
    protected ?string $LunchSaEnd;
    protected ?string $LunchSuBegin;
    protected ?string $LunchSuEnd;
    protected ?string $ScheduleJSON;

    public function __construct(?int $id = null)
    {
        $this->id = $id;
        parent::__construct($this->id);
    }

    /**
     * @param $value
     * @return string|null
     */
    public function getValueField($value, $field = null): ?string
    {
        if(is_string($value) && strlen($value) == 5 && strpos($value, ':'))
            return $value .= ':00';

        if (empty($value)) return null;

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
     * @return string|null
     */
    public function getShortWorkShedule(): ?string
    {
        return $this->ShortWorkShedule;
    }

    /**
     * @param string|null $ShortWorkShedule
     * @retun WorkShedule
     */
    public function setShortWorkShedule(?string $ShortWorkShedule): WorkShedule
    {
        $this->ShortWorkShedule = $ShortWorkShedule;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getWorkMoBegin(): ?string
    {
        return $this->WorkMoBegin;
    }

    /**
     * @param string|null $WorkMoBegin
     * @retun WorkShedule
     */
    public function setWorkMoBegin(?string $WorkMoBegin): WorkShedule
    {
        $this->WorkMoBegin = $WorkMoBegin;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getWorkMoEnd(): ?string
    {
        return $this->WorkMoEnd;
    }

    /**
     * @param string|null $WorkMoEnd
     * @retun WorkShedule
     */
    public function setWorkMoEnd(?string $WorkMoEnd): WorkShedule
    {
        $this->WorkMoEnd = $WorkMoEnd;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getWorkTuBegin(): ?string
    {
        return $this->WorkTuBegin;
    }

    /**
     * @param string|null $WorkTuBegin
     * @retun WorkShedule
     */
    public function setWorkTuBegin(?string $WorkTuBegin): WorkShedule
    {
        $this->WorkTuBegin = $WorkTuBegin;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getWorkTuEnd(): ?string
    {
        return $this->WorkTuEnd;
    }

    /**
     * @param string|null $WorkTuEnd
     * @retun WorkShedule
     */
    public function setWorkTuEnd(?string $WorkTuEnd): WorkShedule
    {
        $this->WorkTuEnd = $WorkTuEnd;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getWorkWeBegin(): ?string
    {
        return $this->WorkWeBegin;
    }

    /**
     * @param string|null $WorkWeBegin
     * @retun WorkShedule
     */
    public function setWorkWeBegin(?string $WorkWeBegin): WorkShedule
    {
        $this->WorkWeBegin = $WorkWeBegin;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getWorkWeEnd(): ?string
    {
        return $this->WorkWeEnd;
    }

    /**
     * @param string|null $WorkWeEnd
     * @retun WorkShedule
     */
    public function setWorkWeEnd(?string $WorkWeEnd): WorkShedule
    {
        $this->WorkWeEnd = $WorkWeEnd;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getWorkThBegin(): ?string
    {
        return $this->WorkThBegin;
    }

    /**
     * @param string|null $WorkThBegin
     * @retun WorkShedule
     */
    public function setWorkThBegin(?string $WorkThBegin): WorkShedule
    {
        $this->WorkThBegin = $WorkThBegin;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getWorkThEnd(): ?string
    {
        return $this->WorkThEnd;
    }

    /**
     * @param string|null $WorkThEnd
     * @retun WorkShedule
     */
    public function setWorkThEnd(?string $WorkThEnd): WorkShedule
    {
        $this->WorkThEnd = $WorkThEnd;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getWorkFrBegin(): ?string
    {
        return $this->WorkFrBegin;
    }

    /**
     * @param string|null $WorkFrBegin
     * @retun WorkShedule
     */
    public function setWorkFrBegin(?string $WorkFrBegin): WorkShedule
    {
        $this->WorkFrBegin = $WorkFrBegin;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getWorkFrEnd(): ?string
    {
        return $this->WorkFrEnd;
    }

    /**
     * @param string|null $WorkFrEnd
     * @retun WorkShedule
     */
    public function setWorkFrEnd(?string $WorkFrEnd): WorkShedule
    {
        $this->WorkFrEnd = $WorkFrEnd;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getWorkSaBegin(): ?string
    {
        return $this->WorkSaBegin;
    }

    /**
     * @param string|null $WorkSaBegin
     * @retun WorkShedule
     */
    public function setWorkSaBegin(?string $WorkSaBegin): WorkShedule
    {
        $this->WorkSaBegin = $WorkSaBegin;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getWorkSaEnd(): ?string
    {
        return $this->WorkSaEnd;
    }

    /**
     * @param string|null $WorkSaEnd
     * @retun WorkShedule
     */
    public function setWorkSaEnd(?string $WorkSaEnd): WorkShedule
    {
        $this->WorkSaEnd = $WorkSaEnd;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getWorkSuBegin(): ?string
    {
        return $this->WorkSuBegin;
    }

    /**
     * @param string|null $WorkSuBegin
     * @retun WorkShedule
     */
    public function setWorkSuBegin(?string $WorkSuBegin): WorkShedule
    {
        $this->WorkSuBegin = $WorkSuBegin;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getWorkSuEnd(): ?string
    {
        return $this->WorkSuEnd;
    }

    /**
     * @param string|null $WorkSuEnd
     * @retun WorkShedule
     */
    public function setWorkSuEnd(?string $WorkSuEnd): WorkShedule
    {
        $this->WorkSuEnd = $WorkSuEnd;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLunchMoBegin(): ?string
    {
        return $this->LunchMoBegin;
    }

    /**
     * @param string|null $LunchMoBegin
     * @retun WorkShedule
     */
    public function setLunchMoBegin(?string $LunchMoBegin): WorkShedule
    {
        $this->LunchMoBegin = $LunchMoBegin;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLunchMoEnd(): ?string
    {
        return $this->LunchMoEnd;
    }

    /**
     * @param string|null $LunchMoEnd
     * @retun WorkShedule
     */
    public function setLunchMoEnd(?string $LunchMoEnd): WorkShedule
    {
        $this->LunchMoEnd = $LunchMoEnd;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLunchTuBegin(): ?string
    {
        return $this->LunchTuBegin;
    }

    /**
     * @param string|null $LunchTuBegin
     * @retun WorkShedule
     */
    public function setLunchTuBegin(?string $LunchTuBegin): WorkShedule
    {
        $this->LunchTuBegin = $LunchTuBegin;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLunchTuEnd(): ?string
    {
        return $this->LunchTuEnd;
    }

    /**
     * @param string|null $LunchTuEnd
     * @retun WorkShedule
     */
    public function setLunchTuEnd(?string $LunchTuEnd): WorkShedule
    {
        $this->LunchTuEnd = $LunchTuEnd;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLunchWeBegin(): ?string
    {
        return $this->LunchWeBegin;
    }

    /**
     * @param string|null $LunchWeBegin
     * @retun WorkShedule
     */
    public function setLunchWeBegin(?string $LunchWeBegin): WorkShedule
    {
        $this->LunchWeBegin = $LunchWeBegin;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLunchWeEnd(): ?string
    {
        return $this->LunchWeEnd;
    }

    /**
     * @param string|null $LunchWeEnd
     * @retun WorkShedule
     */
    public function setLunchWeEnd(?string $LunchWeEnd): WorkShedule
    {
        $this->LunchWeEnd = $LunchWeEnd;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLunchThBegin(): ?string
    {
        return $this->LunchThBegin;
    }

    /**
     * @param string|null $LunchThBegin
     * @retun WorkShedule
     */
    public function setLunchThBegin(?string $LunchThBegin): WorkShedule
    {
        $this->LunchThBegin = $LunchThBegin;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLunchThEnd(): ?string
    {
        return $this->LunchThEnd;
    }

    /**
     * @param string|null $LunchThEnd
     * @retun WorkShedule
     */
    public function setLunchThEnd(?string $LunchThEnd): WorkShedule
    {
        $this->LunchThEnd = $LunchThEnd;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLunchFrBegin(): ?string
    {
        return $this->LunchFrBegin;
    }

    /**
     * @param string|null $LunchFrBegin
     * @retun WorkShedule
     */
    public function setLunchFrBegin(?string $LunchFrBegin): WorkShedule
    {
        $this->LunchFrBegin = $LunchFrBegin;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLunchFrEnd(): ?string
    {
        return $this->LunchFrEnd;
    }

    /**
     * @param string|null $LunchFrEnd
     * @retun WorkShedule
     */
    public function setLunchFrEnd(?string $LunchFrEnd): WorkShedule
    {
        $this->LunchFrEnd = $LunchFrEnd;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLunchSaBegin(): ?string
    {
        return $this->LunchSaBegin;
    }

    /**
     * @param string|null $LunchSaBegin
     * @retun WorkShedule
     */
    public function setLunchSaBegin(?string $LunchSaBegin): WorkShedule
    {
        $this->LunchSaBegin = $LunchSaBegin;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLunchSaEnd(): ?string
    {
        return $this->LunchSaEnd;
    }

    /**
     * @param string|null $LunchSaEnd
     * @retun WorkShedule
     */
    public function setLunchSaEnd(?string $LunchSaEnd): WorkShedule
    {
        $this->LunchSaEnd = $LunchSaEnd;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLunchSuBegin(): ?string
    {
        return $this->LunchSuBegin;
    }

    /**
     * @param string|null $LunchSuBegin
     * @retun WorkShedule
     */
    public function setLunchSuBegin(?string $LunchSuBegin): WorkShedule
    {
        $this->LunchSuBegin = $LunchSuBegin;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLunchSuEnd(): ?string
    {
        return $this->LunchSuEnd;
    }

    /**
     * @param string|null $LunchSuEnd
     * @retun WorkShedule
     */
    public function setLunchSuEnd(?string $LunchSuEnd): WorkShedule
    {
        $this->LunchSuEnd = $LunchSuEnd;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getScheduleJSON(): ?string
    {
        return $this->ScheduleJSON;
    }

    /**
     * @param string|null $ScheduleJSON
     * @retun WorkShedule
     */
    public function setScheduleJSON(?string $ScheduleJSON): WorkShedule
    {
        $this->ScheduleJSON = $ScheduleJSON;
        return $this;
    }
}