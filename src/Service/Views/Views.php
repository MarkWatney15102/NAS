<?php

namespace src\Service\Views;

class Views 
{
    public static function load(string $path)
    {
        require $_SERVER['DOCUMENT_ROOT'] . "/views/" . $path;
    }
}