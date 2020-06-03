<?php

namespace src\Structure\AbstractController;

use src\Service\Views\Views;
use src\Structure\Header\PermissionHelper\PermissionHelper;
use src\Structure\Title\Title;

abstract class AbstractController
{
    /**
     * @var bool
     */
    private $access = true;

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
        if ($this->access) {
            $_SESSION['params'] = $params;

            Views::load($pathToFile);
        }
    }

    /**
     * @param int $permId
     */
    protected function hasAccessForPage(int $permId): void
    {
        if (!PermissionHelper::hasPerm($permId)) {
            $this->access = false;
        } else {
            $this->access = true;
        }
    }
}