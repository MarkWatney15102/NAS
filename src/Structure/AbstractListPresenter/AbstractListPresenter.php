<?php
declare(strict_types=1);

namespace src\Structure\AbstractListPresenter;

abstract class AbstractListPresenter
{
    abstract public function init(): void;

    abstract public function initStructure(): void;

    /**
     * @var string
     */
    private $html;

    /**
     * @var array
     */
    private $structure;

    protected function render(): void
    {
        /**
         * @todo Renderer for List Presenter
         */
    }

    /**
     * @param array $structure
     */
    protected function setStructure(array $structure): void
    {
        $this->structure = $structure;
    }

    /**
     * @return array
     */
    protected function getStructure(): array
    {
        return $this->structure;
    }

    /**
     * @param string $html
     */
    protected function setHtml(string $html): void
    {
        $this->html = $html;
    }

    /**
     * @return string
     */
    protected function getHtml(): string
    {
        return $this->html;
    }
}