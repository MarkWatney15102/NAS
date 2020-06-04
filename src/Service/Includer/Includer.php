<?php

namespace src\Service\Includer;

class Includer
{
    public static function includeJsFile(string $pathToFile): void
    {
        echo '<script type="text/javascript" src="' . $pathToFile . '"></script>';
    }

    public static function includeCssFile(string $pathToFile): void
    {
        echo '<link rel="stylesheet" href="' . $pathToFile . '">';
    }
}
