<?php

namespace src\Structure\AbstractModel;

use Medoo\Medoo;
use src\Helper\Singleton\Singleton;
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
    protected $result;

    /**
     * @var Medoo
     */
    private $db;

    /**
     * @var array
     */
    private $primaryKey;

    /**
     * @var string
     */
    private $tableName;

    public function read(string $primaryKey)
    {
        $db = Database::getInstance()->getConnection();
        $this->db = $db;

        $class = get_called_class();
        $split = explode("\\", $class);
        $class = $split[3];

        $schemaPath = $_SERVER['DOCUMENT_ROOT'] . "/src/Models/{$class}/{$class}.json";

        $schema = JsonParser::parseJsonFile($schemaPath);

        $tableName = $schema->tableName;
        $pk = $schema->pk;

        $this->tableName = $tableName;
        $this->primaryKey[$pk] = $primaryKey;

        $finalMapping = [];

        foreach ($schema->mapping as $tableColumn => $mapping) {
            $this->mapping[$tableColumn] = $mapping;
            $finalMapping[] = $tableColumn;
        }

        $result = $this->db->select(
            $tableName,
            $finalMapping,
            [
                $pk => $primaryKey
            ]
        );

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
        foreach ($this->mapping as $tableName => $mapping) {
            if ((string)$mapping->mapTo === (string)$propName) {
                $this->result[$tableName] = $value;
            }
        }
    }

    public function update()
    {
        $this->db->update($this->tableName, $this->result, $this->primaryKey);
    }
}
