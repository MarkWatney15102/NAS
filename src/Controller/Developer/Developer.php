<?php
declare(strict_types=1);

namespace src\Controller\Developer;

use src\Structure\AbstractController\AbstractController;

class Developer extends AbstractController
{
    public function devDashboard(): void
    {
        $this->setPageTitle("Developer Dashboard");

        $this->render("Dev/Dashboard.php");
    }
}