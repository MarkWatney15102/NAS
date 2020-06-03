<?php

namespace src\Structure\Header;

use src\Structure\Routing\Routing;
use src\Service\Includer\Includer;

class Header
{
    /**
     * @var string
     */
    private $pathToFilePartOne;

    public function __construct()
    {
        $this->setPathToFilePartOne();
    }

    public function loadJsFiles(): void
    {
        $includeFolder = "/src/dist/js";
        $path = $_SERVER['DOCUMENT_ROOT'] . $includeFolder;

        Includer::includeJsFile($this->pathToFilePartOne . "src/dist/js/jquery.min.js");

        foreach (glob("{$path}/*.js") as $filename) {
            if (!strpos($filename, "jquery.min.js")) {
                $file = explode("/", $filename);
                Includer::includeJsFile($this->pathToFilePartOne . "src/dist/js/". end($file));
            }
        }
    }

    public function loadCssFiles(): void
    {
        $includeFolder = "/src/dist/css";
        $path = $_SERVER['DOCUMENT_ROOT'] . $includeFolder;

        foreach (glob("{$path}/*.css") as $filename) {
            $file = explode("/", $filename);
            Includer::includeCssFile($this->pathToFilePartOne . "src/dist/css/". end($file));
        }
    }

    public function loadHeaderInformation(): void
    {
        echo '<meta charset="UTF-8">';
    }

    private function setPathToFilePartOne(): void
    {
        $subroutingcount = Routing::getSubroutingCount();

        $pathToFilePartOne = '';

        for ($i = 0; $i < $subroutingcount; $i++) {
            $pathToFilePartOne .= "../";
        }

        $this->pathToFilePartOne = $pathToFilePartOne;
    }
}