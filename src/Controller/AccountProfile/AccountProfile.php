<?php

namespace src\Controller\AccountProfile;

use src\Models\UserModel\UserModel;
use src\Structure\AbstractController\AbstractController;
use src\Structure\Header\PermissionHelper\PermissionHelper;

class AccountProfile extends AbstractController
{
    /**
     * @param string $param
     */
    public function AccountUserAction(string $param): void
    {
        $this->setPageTitle("Account Profile");

        $user = UserModel::getInstance();
        $user->read($param);

        $permissions = PermissionHelper::getPermissionListForUser($param);

        $this->render("AccountProfile/AccountProfile.php", ['user' => $user, 'permissions' => $permissions]);
    }
}