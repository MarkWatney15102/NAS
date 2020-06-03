<?php
declare(strict_types=1);

namespace src\Controller\Errors;

use src\Structure\AbstractController\AbstractController;

class Errors extends AbstractController
{
    public function noPermissionsAction(): void
    {
        $this->setPageTitle("403. Access Denied");
    }
}