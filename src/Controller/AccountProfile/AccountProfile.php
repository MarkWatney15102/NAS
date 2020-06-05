<?php

namespace src\Controller\AccountProfile;

use src\Models\UserModel\UserModel;
use src\Service\CurrentUser\CurrentUser;
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

        $currentUser = CurrentUser::get();

        $user = UserModel::getInstance();
        $user->read($param);


        $permissions = PermissionHelper::getPermissionListForUser((int)$param);

        $unsetPermissions = [];
        $setPermissions = [];

        foreach ($permissions as $key => $permission) {
            if (empty($permission['set'])) {
                $unsetPermissions[] = [
                    $permission['permId'],
                    $permission['name'],
                    $permission['description']
                ];
            } else {
                $setPermissions[] = [
                    $permission['permId'],
                    $permission['name'],
                    $permission['description']
                ];
            }
        }

        $this->render("AccountProfile/AccountProfile.php", ['user' => $user, 'currentUser' => $currentUser, 'unsetPermissions' => $unsetPermissions, 'setPermissions' => $setPermissions]);
    }
}