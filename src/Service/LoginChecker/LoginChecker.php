<?php

namespace src\Service\LoginChecker;

use Medoo\Medoo;
use src\Models\UserModel\UserModel;
use src\Service\Redirect\Redirect;
use src\Structure\Database\Database;

class LoginChecker
{

    /**
     * @var Medoo
     */
    private $db;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var int
     */
    private $userId = 0;

    public function __construct(string $username, string $password)
    {
        $db = Database::getInstance()->getConnection();
        $this->db = $db;

        $this->username = $username;
        $this->password = $password;

        $this->checkLoginData();
    }

    private function checkLoginData(): void
    {
        if (isset($this->username) && $this->username !== "") {
            if (isset($this->password) && $this->password !== "") {
                $data = $this->db->select("user", [
                    "id",
                    "username",
                    "password"
                ], [
                    "username" => $this->username
                ]);

                $userData = $data[0];


                if (password_verify($this->password, $userData['password'])) {
                    /** @var UserModel $user */
                    $user = UserModel::getInstance();
                    $user->read($userData['id']);

                    if ($user->getStatus() === 1) {
                        $this->setUID($userData['id']);
                        $this->userId = $userData['id'];
                    } else {
                        echo 'Account is Disabled';
                    }
                } else {
                    echo 'wrong password';
                }
            } else {
                echo 'empty password';
            }
        } else {
            echo 'empty Username';
        }
    }

    private function setUID(string $uid): void
    {
        setcookie("UID", $uid, time() + (3600 * 24 * 7));
    }

    public static function isLoggedIn(): void
    {
        if (!isset($_COOKIE['UID'])) {
            if ($_SERVER['REQUEST_URI'] !== "/login") {
                Redirect::to("/login");
            }
        }
    }

    public static function isLoggedInAndDisabled(): void
    {
        if (isset($_COOKIE['UID'])) {
            /** @var UserModel $user */
            $user = UserModel::getInstance();
            $user->read($_COOKIE['UID']);
            if ($user->getStatus() === 0) {
                Redirect::to("/logout");
            }
        }
    }

    public static function isUserLoggedIn(): bool
    {
        if (isset($_COOKIE['UID'])) {
            return true;
        }

        return false;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }
}