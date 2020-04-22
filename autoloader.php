<?php

require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
require $_SERVER['DOCUMENT_ROOT'] . '/const.php';

$includeDir = [
    $_SERVER['DOCUMENT_ROOT'] . "/src/Helper",
    $_SERVER['DOCUMENT_ROOT'] . "/src/Structure",
    $_SERVER['DOCUMENT_ROOT'] . "/src/Provider",
    $_SERVER['DOCUMENT_ROOT'] . "/src/Service",
    $_SERVER['DOCUMENT_ROOT'] . "/src/Controller",
    $_SERVER['DOCUMENT_ROOT'] . "/src/Models",
];

foreach ($includeDir as $key => $folder) {
    $directories = glob($folder . '/*', GLOB_ONLYDIR);
    foreach ($directories as $directorie) {
        foreach (glob("{$directorie}/*.php") as $filename) {
            include $filename;
        }
    }
}

require $_SERVER['DOCUMENT_ROOT'] . "/config/Config.php";
