<?php
declare(strict_types=1);

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
     * @param array $condition
     */
    public function findOneBy(array $condition = []): void
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

        if ($data[0] !== null) {
            $this->result = $data[0];
        }
    }

    /**
     * @param array $condition
     */
    public function findAllBy(array $condition = []): void
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

        if ($data !== null) {
            $this->result = $data;
        }
    }

    /**
     * @param string $propName
     * @return string
     */
    public function getProp(string $propName): string
    {
        $value = '';

        foreach ($this->mapping as $tableName => $mapping) {
            if ((string)$mapping->mapTo === $propName) {
                $value = $this->result[$tableName];
            }
        }

        return $value;
    }

    /**
     * @return array
     */
    public function getAllProps(): array
    {
        return $this->result;
    }

    /**
     * @return bool
     */
    public function checkOnEmpty(): bool
    {
        if (empty($this->result)) {
            return true;
        }
        return false;
    }
}