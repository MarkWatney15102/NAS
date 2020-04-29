<?php

namespace src\Structure\Permission\Permissions;

use Medoo\Medoo;
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

    /**
     * Permissions constructor.
     * @param int $userId
     */
    public function __construct(int $userId)
    {
        $this->db = Database::getInstance()->getConnection();
        $this->userId = $userId;

        $this->setUserPermissions();
    }

    private function setUserPermissions(): void
    {
        $userPermission = UserPermissionModelContainer::getInstance();
        $userPermission->findAllBy(["user_id" => $this->userId]);

        $this->userPermissions = $userPermission->getAllProps();
    }

    /**
     * @return array
     */
    public function getUserPermissions(): array
    {
        return $this->userPermissions;
    }
}