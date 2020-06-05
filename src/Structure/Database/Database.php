<?php

namespace src\Structure\Database;

use Medoo\Medoo;
use src\Helper\Singleton\Singleton;

class Database extends Singleton
{
    public function getConnection(): Medoo
    {
        return new Medoo([
            'database_type' => 'mysql',
            'database_name' => 'nas',
            'server' => 'localhost',
            'username' => 'root',
            'password' => '',
        ]);
    }
}
