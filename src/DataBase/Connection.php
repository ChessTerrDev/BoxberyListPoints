<?php
declare(strict_types=1);

namespace BoxberryListPoints\DataBase;

use BoxberryListPoints\Config\Constants;

class Connection implements ConnectionInterfase
{
    private string $driver;
    private string $host;
    private string $database;
    private string $username;
    private string $password;

    public function __construct()
    {
        $db = Constants::DATA_BASE_CONNECTION;

        $this->driver = $db['driver'];
        $this->host = $db['host'];
        $this->database = $db['database'];
        $this->username = $db['username'];
        $this->password = $db['password'];
    }

    public function connect(): \PDO
    {
       return new \PDO(
            "{$this->driver}:host={$this->host};dbname={$this->database}",
            $this->username,
            $this->password
        );
    }
}