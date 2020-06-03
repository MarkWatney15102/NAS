<?php

namespace src\Controller\Home;

use src\Models\UserFileUploadsModel\UserFileUploadsModelContainer;
use src\Service\CurrentUser\CurrentUser;
use src\Structure\AbstractController\AbstractController;

class Home extends AbstractController
{
    public function homeAction()
    {
        $this->setPageTitle("Dashboard");


        $userFiles = UserFileUploadsModelContainer::getInstance();
        $data = $userFiles->findAllBy(["user_id" => CurrentUser::get()->getProp('id')]);

        $this->render("Home/Home.php");
    }
}
