<?php

namespace src\Service\Views;

use src\Service\LoginChecker\LoginChecker;

class Views
{
    public static function load(string $path)
    {
        require $_SERVER['DOCUMENT_ROOT'] . "/views/" . $path;
    }
}
