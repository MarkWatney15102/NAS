<?php

namespace src\Structure\AbstractFormData\AbstractFormData;

abstract class AbstractFormData
{
    /**
     * @var array
     */
    protected $structure;

    public function setStructure(array $structure): void
    {
        $this->structure = $structure;
    }

    public function getStructure(): array
    {
        return $this->structure;
    }

    /**
     * @todo AbstractFormData
     * [
     *      [
     *          "name" => "test",
     *          "element => "input['text']",
     *          "read" => "closure",
     *          "write" => "closure",
     *          "permission" => "permission"
     *      ]
     * }
     */
    public function load()
    {
    }
}