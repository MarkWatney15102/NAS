<?php 

namespace src\Service\JsonParser;

class JsonParser
{
    public static function parseJsonFile(string $jsonFilePath)
    {
        $jsonFile = file_get_contents($jsonFilePath);
        $json = json_decode($jsonFile);

        return $json;
    }
}

