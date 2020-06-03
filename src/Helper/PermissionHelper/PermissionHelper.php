<?php
declare(strict_types=1);

namespace src\Structure\Header\PermissionHelper;

use src\Models\PermissionModel\PermissionModelContainer;
use src\Models\UserPermissionModel\UserPermissionModel;
use src\Models\UserPermissionModel\UserPermissionModelContainer;
use src\Service\CurrentUser\CurrentUser;

class PermissionHelper
{
    /**
     * @param int $permId
     * @return bool
     */
    public static function hasPerm(int $permId): bool
    {
        $currentUser = CurrentUser::get();
        $userId = $currentUser->getProp('id');

        return self::hasPermWithUserId($permId, $userId);
    }

    /**
     * @param int $permId
     * @param int $userId
     * @return bool
     */
    public static function hasPermWithUserId(int $permId, int $userId): bool
    {
        $userPermission = UserPermissionModelContainer::getInstance();
        $userPermission->findAllBy(['user_id' => $userId]);
        $permissions = $userPermission->getAllProps();

        $finalPermissions = [];

        foreach ($permissions as $permission) {
            $finalPermissions[] = $permission['permission_id'];
        }

        if (in_array($permId, $finalPermissions, true)) {
            return true;
        }

        return false;
    }

    /**
     * @param int $userId
     * @return array
     */
    public static function getPermissionListForUser(int $userId): array
    {
        $permissions = PermissionModelContainer::getInstance();
        $permissions->findAllBy();

        $permissionList = $permissions->getAllProps();

        $userPermissionList = [];

        foreach ($permissionList as $key => $permission) {
            $permId = $permission['id'];

            $userPermission = UserPermissionModelContainer::getInstance();
            $userPermission->findAllBy(['user_id' => $userId]);

            $userPermissionList[$key]['permId'] = $permId;
            $userPermissionList[$key]['name'] = $permission['name'];
            $userPermissionList[$key]['description'] = $permission['description'];
            $userPermissionList[$key]['set'] = self::hasPermWithUserId((int)$permId, $userId);
        }

        return $userPermissionList;
    }
}