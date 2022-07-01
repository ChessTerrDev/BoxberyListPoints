<?php

namespace BoxberryListPoints\Controllers\Update\ListPoints;


class ListPoints extends ListPointsMethods
{
    public function __construct(bool $prepaid = true)
    {
        parent::__construct('ListPoints');

        $this->param['prepaid'] = $prepaid;
    }
}