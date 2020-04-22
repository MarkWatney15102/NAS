<?php

namespace src\Controller\Home;

use src\Service\Views\Views;
use src\Structure\AbstractController\AbstractController;
use src\Structure\Title\Title;

class Home extends AbstractController
{
    public function homeAction()
    {
        Title::setTitle("Dashboard");

        Views::load("Home/Home.php");
    }
}
