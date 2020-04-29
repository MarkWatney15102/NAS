<?php

namespace src\Provider\AccountListProvider;

use Medoo\Medoo;
use src\Structure\Database\Database;

class AccountListProvider
{
    /**
     * @return array
     */
    public function getAllUserAccounts(): array
    {
        /** @var Medoo $db */
        $db = Database::getInstance()->getConnection();
        return $db->select("user", [
            "id",
            "username",
            "firstname",
            "lastname",
            "email",
            "active",
            "online",
            "create_time"
        ]);
    }
}