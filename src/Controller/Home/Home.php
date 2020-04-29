<?php

namespace src\Controller\Home;

use src\Service\Views\Views;
use src\Structure\AbstractController\AbstractController;

class Home extends AbstractController
{
    public function homeAction()
    {
        $this->setPageTitle("Dashboard");

        $this->render("Home/Home.php");
    }
}
