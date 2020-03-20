<?php

namespace src\Service\LoginChecker;

use src\Service\Redirect\Redirect;

class LoginChecker
{
    public static function isLoggedIn()
    {
        if (!isset($_SESSION['UID'])) {
            if ($_SERVER['REQUEST_URI'] != "/login") {
                Redirect::to("/login");
            }
        }
    }
}