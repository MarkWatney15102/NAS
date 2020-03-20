<?php

namespace src\Service\Redirect;

class Redirect
{
    public static function to(string $to)
    {
        header("Location: " . $to);
    }
}
