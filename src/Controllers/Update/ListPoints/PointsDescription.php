<?php

namespace BoxberryListPoints\Controllers\Update\ListPoints;


class PointsDescription extends AbstractPoints
{

    public function __construct(string $code, bool $photo = false)
    {
        parent::__construct('PointsDescription');

        $this->param['code'] = $code;
        $this->param['photo'] = $photo;
    }

    public function loadPointsDescription(array $param = [])
    {
        $this->param = array_merge($this->param, $param);
        $this->loadListPoints($this->param);
        return $this;
    }


}