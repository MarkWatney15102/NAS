<?php
declare(strict_types=1);

namespace src\Controller\Account;

use src\Models\UserModel\UserModel;
use src\Service\LoginChecker\LoginChecker;
use src\Service\Redirect\Redirect;
use src\Service\Views\Views;
use src\Structure\AbstractController\AbstractController;
use src\Structure\Title\Title;

class Account extends AbstractController
{
    /**
     * @param string $param
     */
    public function disableAccountAction(string $param): void
    {
        $user = UserModel::getInstance();
        $user->read($param);

        $user->setProp('active', '0');
        $user->update();

        Redirect::to("/home");
    }

    /**
     * @param string $param
     */
    public function enableAccountAction(string $param): void
    {
        $user = UserModel::getInstance();
        $user->read($param);

        $user->setProp('active', '1');
        $user->update();

        Redirect::to("/home");
    }

    public function loginAction(): void
    {
        Title::setTitle("Login");

        Views::load("Login/Login.php");

        if (isset($_POST['login'])) {
            $username = htmlentities($_POST['username']);
            $password = htmlentities($_POST['password']);

            $loginChecker = new LoginChecker($username, $password);
        }
    }

    public function logoutAction(): void
    {
        setcookie('UID', "", -1, '/');
        Redirect::to("/login");
    }
}