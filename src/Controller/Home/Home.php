<?php

namespace src\Controller\Home;

use PhpExtended\System\Solaris;
use src\Models\UserModel\UserModel;
use src\Service\CurrentUser\CurrentUser;
use src\Structure\AbstractController\AbstractController;

class Home extends AbstractController
{
    public function homeAction(): void
    {
        $this->setPageTitle("Dashboard");

        /** @var UserModel $currentUser */
        $currentUser = CurrentUser::get();

        $dev = $currentUser->getDev();

        $sysInfo = [];

        var_dump(Solaris::get());

        $this->render("Home/Home.php", ['dev' => $dev, 'sysInfo' => $sysInfo]);
    }
}
