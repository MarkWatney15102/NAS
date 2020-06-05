<?php
declare(strict_types=1);

namespace src\Controller\Account;

use Medoo\Medoo;
use src\Helper\Generator\Generator;
use src\Models\UserModel\UserModel;
use src\Service\CurrentUser\CurrentUser;
use src\Service\LoginChecker\LoginChecker;
use src\Service\Redirect\Redirect;
use src\Service\Views\Views;
use src\Structure\AbstractController\AbstractController;
use src\Structure\Database\Database;
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

        Redirect::to($_SERVER['HTTP_REFERER']);
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

        Redirect::to($_SERVER['HTTP_REFERER']);
    }

    public function loginAction(): void
    {
        Title::setTitle("Login");

        Views::load("Login/Login.php");

        if (isset($_POST['login'])) {
            $username = htmlentities($_POST['username']);
            $password = htmlentities($_POST['password']);

            $loginChecker = new LoginChecker($username, $password);

            if ($loginChecker->getUserId() !== 0) {
                /** @var UserModel $user */
                $user = UserModel::getInstance();
                $user->read((string)$loginChecker->getUserId());
                $user->setProp('online', '1');
                $user->update();
            }

            Redirect::to("/home");
        }
    }

    public function logoutAction(): void
    {
        /** @var UserModel $user */
        $user = CurrentUser::get();

        $user->setProp('online', '0');
        $user->update();

        setcookie('UID', "", -1, '/');
        Redirect::to("/login");
    }

    public function addPermission(): void
    {
        $permId = htmlentities($_POST['permId']);
        $userId = htmlentities($_POST['userId']);
        $backUrl = $_POST['backUrl'];

        if ((int)$permId !== 0) {
            /** @var Medoo $db */
            $db = Database::getInstance()->getConnection();

            $db->insert('user_permissions', [
                'user_id' => $userId,
                'permission_id' => $permId
            ]);
        }

        Redirect::to($backUrl);
    }

    public function removePermission(): void
    {
        $permId = htmlentities($_POST['permId']);
        $userId = htmlentities($_POST['userId']);
        $backUrl = $_POST['backUrl'];

        if ((int)$permId !== 0) {
            /** @var Medoo $db */
            $db = Database::getInstance()->getConnection();

            $db->delete('user_permissions', [
                'user_id' => $userId,
                'permission_id' => $permId
            ]);
        }

        Redirect::to($backUrl);
    }

    public function createAccount(): void
    {
        $this->setPageTitle("Create Account");

        $this->render('Account/CreateAccount.php');
    }

    public function createAccountForm(): void
    {
        $loginName = htmlentities($_POST['login_name']);
        $regMail = htmlentities($_POST['reg_mail']);
        $pass1 = htmlentities($_POST['password']);
        $pass2 = htmlentities($_POST['password_repeat']);

        $firstName = htmlentities($_POST['first_name']);
        $lastName = htmlentities($_POST['last_name']);
        $backUrl = $_POST['backUrl'];

        if (
            !empty($loginName) &&
            !empty($regMail) &&
            !empty($pass1) &&
            !empty($pass2) &&
            !empty($firstName) &&
            !empty($lastName)
        ) {
            if ($pass1 === $pass2) {
                $finalPassword = password_hash($pass1, PASSWORD_BCRYPT );
                /** @var Medoo $db */
                $db = Database::getInstance()->getConnection();
                $db->insert('user', [
                    "id" => Generator::generateUid(),
                    "username" => $loginName,
                    "password" => $finalPassword,
                    "firstname" => $firstName,
                    "lastname" => $lastName,
                    "email" => $regMail,
                    "active" => 1,
                    "online" => 0,
                    "dev" => 0
                ]);
            }
        }

        Redirect::to($backUrl);
    }

    public function removeDev(string $param): void
    {
        if (CurrentUser::get()->getDev()) {
            $user = UserModel::getInstance();
            $user->read($param);
            $user->setProp('dev', '0');
            $user->update();
        }

        Redirect::to($_SERVER['HTTP_REFERER']);
    }

    public function setDev(string $param): void
    {
        if (CurrentUser::get()->getDev()) {
            $user = UserModel::getInstance();
            $user->read($param);
            $user->setProp('dev', '1');
            $user->update();
        }

        Redirect::to($_SERVER['HTTP_REFERER']);
    }
}