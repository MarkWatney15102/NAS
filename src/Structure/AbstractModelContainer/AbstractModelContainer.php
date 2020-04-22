<?php

namespace src\Structure\AbstractModelContainer;

use Medoo\Medoo;
use src\Helper\Singleton\Singleton;
use src\Service\JsonParser\JsonParser;
use src\Structure\Database\Database;

abstract class AbstractModelContainer extends Singleton
{   
    /**
     * @var array
     */
    private $mapping;

    /**
     * @var array
     */
    private $result;

    /**
     * @param $condition array -> dbfields
     */
    public function findOneBy(array $condition)
    {
        /** @var Medoo $db */
        $db = Database::getInstance()->getConnection();

        $class = get_called_class();
        $split = explode("\\", $class);
        $class = $split[3];
        $class = str_replace("Container", "", $class);

        $schemaPath = $_SERVER['DOCUMENT_ROOT'] . "/src/Models/{$class}/{$class}.json";

        $schema = JsonParser::parseJsonFile($schemaPath);
        $tableName = $schema->tableName;

        $finalMapping = [];

        foreach ($schema->mapping as $tableCollumn => $mapping) {
            $this->mapping[$tableCollumn] = $mapping;
            $finalMapping[] = $tableCollumn;
        }

        $data = $db->select($tableName, $finalMapping, $condition);

        $this->result = $data[0];
    }

    public function findAllBy(array $condition)
    {
        /** @var Medoo $db */
        $db = Database::getInstance()->getConnection();

        $class = get_called_class();
        $split = explode("\\", $class);
        $class = $split[3];
        $class = str_replace("Container", "", $class);

        $schemaPath = $_SERVER['DOCUMENT_ROOT'] . "/src/Models/{$class}/{$class}.json";

        $schema = JsonParser::parseJsonFile($schemaPath);
        $tableName = $schema->tableName;

        $finalMapping = [];

        foreach ($schema->mapping as $tableCollumn => $mapping) {
            $this->mapping[$tableCollumn] = $mapping;
            $finalMapping[] = $tableCollumn;
        }

        $data = $db->select($tableName, $finalMapping, $condition);

        $this->result = $data;
    }

    public function getProp(string $propName)
    {
        $value = '';

        foreach ($this->mapping as $tableName => $mapping) {
            if ((string)$mapping->mapTo === (string)$propName) {
                $value = $this->result[$tableName];
            }
        }

        return $value;
    }

    public function getAllProps()
    {
        return $this->result;
    }
}