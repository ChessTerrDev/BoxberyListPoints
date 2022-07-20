<?php
declare(strict_types=1);

namespace BoxberryListPoints\Config;

class Constants
{
    public const DATA_BASE_CONNECTION = [
        'driver' => 'pgsql',
        'host' => 'localhost',
        'username' => 'username',
        'password' => 'password',
        'database' => 'BoxberryListPoints'
    ];

    public const BOXBERRY = [
        'token' => 'd6f33e419c16131e5325cbd84d5d6000'
    ];
}