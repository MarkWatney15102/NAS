<?php


namespace src\Structure\Heading\Heading;

use Medoo\Medoo;
use src\Service\LoginChecker\LoginChecker;
use src\Service\Views\Views;
use src\Structure\Database\Database;
use src\Structure\Routing\Routing;

class Heading
{
    /**
     * @var Medoo
     */
    private $db;

    private $structure;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();

        $this->initStructure();
    }

    private function initStructure()
    {
        /**
         * @todo Heading Structur über array Steuern
         */
    }

    public function loadHeading()
    {
        $loggedIn = LoginChecker::isUserLoggedIn();

        if (!Routing::checkApiCall()) {
            require $_SERVER['DOCUMENT_ROOT'] . "/views/Header/Header.php";
        }
    }
}
