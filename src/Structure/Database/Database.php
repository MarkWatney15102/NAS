<?php

namespace src\Structure\Database;

use Medoo\Medoo;
use src\Service\Singleton\Singleton;

class Database extends Singleton
{
    public function getConnection()
    {
        return new Medoo([
            'database_type' => 'mysql',
            'database_name' => 'noname',
            'server' => 'localhost',
            'username' => 'root',
            'password' => '',
        ]);
    }
}
