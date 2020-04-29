<?php

namespace src\Structure\AbstractController;

use src\Service\Views\Views;
use src\Structure\Title\Title;

abstract class AbstractController
{
    /**
     * @param string $title
     */
    protected function setPageTitle(string $title): void
    {
        Title::setTitle($title);
    }

    /**
     * @param string $pathToFile
     * @param array $params
     */
    protected function render(string $pathToFile, array $params = []): void
    {
        $_SESSION['params'] = $params;

        Views::load($pathToFile);
    }
}