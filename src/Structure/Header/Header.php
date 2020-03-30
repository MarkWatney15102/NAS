<?php

namespace src\Structure\Header;

use src\Structure\Database\Database;
use src\Structure\Routing\Routing;
use src\Service\Includer\Includer;

class Header
{
    /**
     * @var Medoo
     */
    private $db;

    /**
     * @var string
     */
    private $pathToFilePartOne;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
        $this->setPathToFilePartOne();
    }

    public function loadJsFiles()
    {
        $includeFolder = "/src/dist/js";
        $path = $_SERVER['DOCUMENT_ROOT'] . $includeFolder;

        foreach (glob("{$path}/*.js") as $filename) {
            $file = explode("/", $filename);
            Includer::includeJsFile($this->pathToFilePartOne . "src/dist/js/". end($file));
        }
    }

    public function loadCssFiles()
    {
        $includeFolder = "/src/dist/css";
        $path = $_SERVER['DOCUMENT_ROOT'] . $includeFolder;

        foreach (glob("{$path}/*.css") as $filename) {
            $file = explode("/", $filename);
            Includer::includeCssFile($this->pathToFilePartOne . "src/dist/css/". end($file));
        }
    }

    private function setPathToFilePartOne()
    {
        $subroutingcount = Routing::getSubroutingCount();

        $pathToFilePartOne = '';

        for ($i = 0; $i < $subroutingcount; $i++) {
            $pathToFilePartOne .= "../";
        }

        $this->pathToFilePartOne = $pathToFilePartOne;
    }
}