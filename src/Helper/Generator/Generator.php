<?php
declare(strict_types=1);

namespace src\Helper\Generator;

use Medoo\Medoo;
use src\Structure\Database\Database;

class Generator
{
    public static function generateUid(): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 25; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        /** @var Medoo $db */
        $db = Database::getInstance()->getConnection();
        $result = $db->select('user', ['reg_mail'], ['id' => $randomString]);

        while (!empty($result)) {
            $randomString = self::generateUid();
        }

        return $randomString;
    }
}