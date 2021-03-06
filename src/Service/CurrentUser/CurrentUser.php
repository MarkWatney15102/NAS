<?php

namespace src\Service\CurrentUser;

use src\Models\UserModel\UserModel;

class CurrentUser
{
    public static function get()
    {
        if (isset($_COOKIE['UID'])) {
            $user = UserModel::getInstance(self::class);
            $user->read($_COOKIE['UID']);

            return $user;
        }

        return null;
    }
}