<?php

namespace src\Service\Includer;

class Includer
{
    public static function includeJsFile(string $pathToFile)
    {
        echo '<script type="text/javascript" src="' . $pathToFile . '"></script>';
    }

    public static function includeCssFile(string $pathToFile)
    {
        echo '<link rel="stylesheet" href="' . $pathToFile . '">';
    }
}
