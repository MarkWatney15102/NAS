<?php
declare(strict_types=1);

namespace src\Controller\Api;

use src\Structure\AbstractController\AbstractController;
use src\Structure\Header\PermissionHelper\PermissionHelper;

class Api extends AbstractController
{
    /**
     * @param string $param
     */
    public function accountProfilePermissionLoadDataAction(string $param): void
    {
        $permissions = PermissionHelper::getPermissionListForUser((int)$param);

        $data = [];

        foreach ($permissions as $key => $permission) {
            $data['data'][] = [
                $permission['permId'],
                $permission['name'],
                $permission['description'],
                ($permission['set'] ? "1" : "0")
            ];
        }

        echo json_encode($data);
    }
}