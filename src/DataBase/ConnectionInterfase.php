<?php
declare(strict_types=1);

namespace BoxberryListPoints\DataBase;

interface ConnectionInterfase
{
    public function connect(): \PDO;
}