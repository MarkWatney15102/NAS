<?php

namespace src\Structure\Permission\Permissions;

use Medoo\Medoo;
use src\Models\UserPermissionModel\UserPermissionModel;
use src\Models\UserPermissionModel\UserPermissionModelContainer;
use src\Structure\Database\Database;

class Permissions
{
    /**
     * @var Medoo
     */
    private $db;

    /**
     * @var int
     */
    private $userId;

    /**
     * @var array
     */
    private $userPermissions;

    public function __construct(int $userId)
    {
        $this->db = Database::getInstance()->getConnection();
        $this->userId = $userId;

        $this->setUserPermissions();
    }

    private function setUserPermissions()
    {
        $userPermission = UserPermissionModelContainer::getInstance();
        $userPermission->findAllBy(["user_id" => $this->userId]);

        $this->userPermissions = $userPermission->getAllProps();
    }

    public function getUserPermissions()
    {
        return $this->userPermissions;
    }
}