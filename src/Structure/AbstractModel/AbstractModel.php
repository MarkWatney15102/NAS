<?php

namespace src\Structure\AbstractModel;

use src\Service\Singleton\Singleton;
use src\Service\JsonParser\JsonParser;
use src\Structure\Database\Database;

abstract class AbstractModel extends Singleton
{
    /**
     * @var array
     */
    private $mapping;

    /**
     * @var array
     */
    private $result;

    public function read(int $primaryKey) 
    {
        $class = get_called_class();
        $split = explode("\\", $class);
        $class = $split[3];

        $schemaPath = $_SERVER['DOCUMENT_ROOT'] . "/src/Models/{$class}/{$class}.json";

        $schema = JsonParser::parseJsonFile($schemaPath);

        $tableName = $schema->tableName;
        $pk = $schema->pk;

        $db = Database::getInstance()->getConnection();

        $finalMapping = [];

        foreach ($schema->mapping as $tableCollumn => $mapping) {
            $this->mapping[$tableCollumn] = $mapping;
            $finalMapping[] = $tableCollumn;
        }

        $result = $db->select($tableName, 
        $finalMapping,
        [
            $pk => $primaryKey
        ]);

        $this->result = $result[0];
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

    public function setProp(string $propName, string $value) 
    {
        /** @todo Set Logic */
    }

    public function createOrUpdate()
    {
        /** @todo Create or Update Logic */
    }
}
