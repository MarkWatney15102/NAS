<?php

namespace src\Controller\Login;

use src\Structure\AbstractController\AbstractController;
use src\Service\Views\Views;
use src\Service\LoginChecker\LoginChecker;
use src\Structure\Title\Title;

class Login extends AbstractController
{
    public function loginAction()
    {
        Title::setTitle("Login");

        Views::load("Login/Login.php");

        if (isset($_POST['login'])) {
            $username = htmlentities($_POST['username']);
            $password = htmlentities($_POST['password']);

            $loginChecker = new LoginChecker($username, $password);
        }
    }
}