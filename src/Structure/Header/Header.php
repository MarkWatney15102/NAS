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
        $this->pathToFilePartOne = self::setPathToFilePartOne();
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

        $this->loadControllerJsFiles();
    }

    public function loadCssFiles(): void
    {
        $includeFolder = "/src/dist/css";
        $path = $_SERVER['DOCUMENT_ROOT'] . $includeFolder;

        foreach (glob("{$path}/*.css") as $filename) {
            $file = explode("/", $filename);
            Includer::includeCssFile($this->pathToFilePartOne . "src/dist/css/". end($file));
        }

        $this->loadControllerCSSFiles();
    }

    public function loadHeaderInformation(): void
    {
        echo '<meta charset="UTF-8">';
    }

    public static function setPathToFilePartOne(): string
    {
        $subroutingcount = Routing::getSubroutingCount();

        $pathToFilePartOne = '';

        for ($i = 0; $i < $subroutingcount; $i++) {
            $pathToFilePartOne .= "../";
        }

        return $pathToFilePartOne;
    }

    private function loadControllerJsFiles(): void
    {
        $includeFolder = $_SERVER['DOCUMENT_ROOT'] . "/src/Controller";
        $path = "src/Controller";

        $dirs = glob($includeFolder . "/*", GLOB_ONLYDIR);

        foreach ($dirs as $dir) {
            foreach (glob("{$dir}/js/*.js") as $filename) {
                $file = explode("/", $filename);
                $controllerName = array_slice($file, -3, 1, true);
                Includer::includeJsFile($this->pathToFilePartOne . $path . "/" . $controllerName[5] . "/js/". end($file));
            }
        }
    }

    private function loadControllerCSSFiles(): void
    {
        $includeFolder = $_SERVER['DOCUMENT_ROOT'] . "/src/Controller";
        $path = "src/Controller";

        $dirs = glob($includeFolder . "/*", GLOB_ONLYDIR);

        foreach ($dirs as $dir) {
            foreach (glob("{$dir}/css/*.css") as $filename) {
                $file = explode("/", $filename);
                $controllerName = array_slice($file, -3, 1, true);
                Includer::includeJsFile($this->pathToFilePartOne . $path . "/" . $controllerName[5] . "/css/". end($file));
            }
        }
    }
}