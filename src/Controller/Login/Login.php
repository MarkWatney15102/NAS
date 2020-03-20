<?php

namespace src\Controller\Login;

use src\Structure\AbstractController\AbstractController;
use src\Service\Views\Views;

class Login extends AbstractController
{
    public function loginAction()
    {
        Views::load("Login/Login.php");
    }
}