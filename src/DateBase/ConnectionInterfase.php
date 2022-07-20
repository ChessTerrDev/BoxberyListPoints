<?php
declare(strict_types=1);

namespace BoxberryListPoints\DateBase;

interface ConnectionInterfase
{
    public function connect(): \PDO;
}