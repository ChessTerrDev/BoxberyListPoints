<?php

namespace BoxberryListPoints\Models;

use BoxberryListPoints\Configuration\Constants;
use Illuminate\Database\Capsule\Manager as Capsule;

class DataBase
{
    public function __construct()
    {
            $capsule = new Capsule;
            $capsule->addConnection(Constants::DATA_BASE_CONNECTION);
            $capsule->bootEloquent();
    }
}