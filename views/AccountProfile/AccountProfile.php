<?php
use src\Models\UserModel\UserModel;

    $params = $_SESSION['params'];

    /** @var UserModel $user */
    $user = $params['user'];

    $unsetPermissions = $params['unsetPermissions'];
    $setPermissions = $params['setPermissions'];

    /** @var UserModel $currentUser */
    $currentUser = $params['currentUser'];
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Information</h5>
                </div>
                <div class="card-body">
                    Login Name: <?= $user->getUsername() ?>
                    <br>
                    Full Name: <?= $user->getFirstname() . " " . $user->getLastname() ?>
                    <br>
                    E-Mail: <?= $user->getRegMail() ?>
                    <br>
                    Account Status: <?= $user->getStatus() ?>
                    <br>
                    Create Time: <?= $user->getCreateTime()->format('d.m.Y') ?>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Functions</h5>
                </div>
                <div class="card-body">
                    <label>Change Account Status</label>
                    <?php if ($user->getStatus() === 1): ?>
                        <a class="btn btn-block btn-outline-danger" href="/admin/account/disable/<?= $user->getUserId() ?>">Disable User</a>
                    <?php elseif ($user->getStatus() === 0): ?>
                        <a class="btn btn-block btn-outline-success" href="/admin/account/enable/<?= $user->getUserId() ?>">Enable User</a>
                    <?php endif; ?>
                    <?php
                        if ($currentUser->getDev()) { ?>
                            <label>Change Dev Status</label>
                            <?php if ($user->getDev() === 1): ?>
                                <a class="btn btn-block btn-outline-danger" href="/admin/account/removeDev/<?= $user->getUserId() ?>">Remove Dev</a>
                            <?php elseif ($user->getDev() === 0): ?>
                                <a class="btn btn-block btn-outline-success" href="/admin/account/setDev/<?= $user->getUserId() ?>">Set Dev</a>
                            <?php endif; ?>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Manage Permissions</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <form action="/account/form/addPerm" method="post">
                                <input type="hidden" name="userId" value="<?= $user->getUserId() ?>">
                                <input type="hidden" name="backUrl" value="http://<?= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>">
                                <label for="permId">Set Permissions</label>
                                <select class="form-control" name="permId" id="permId">
                                    <option value="0">-- Please Choose --</option>
                                    <?php
                                    foreach ($unsetPermissions as $permission) { ?>
                                        <option value="<?= $permission[0] ?>"><?= $permission[1] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <br>
                                <input type="submit" class="btn btn-block btn-outline-success" value="Add Permission">
                            </form>
                        </div>
                        <div class="col-lg-6">
                            <form action="/account/form/removePerm" method="post">
                                <input type="hidden" name="userId" value="<?= $user->getUserId() ?>">
                                <input type="hidden" name="backUrl" value="http://<?= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>">
                                <label for="permId">Remove Permissions</label>
                                <select class="form-control" name="permId" id="permId">
                                    <option value="0">-- Please Choose --</option>
                                    <?php
                                    foreach ($setPermissions as $permission) { ?>
                                        <option value="<?= $permission[0] ?>"><?= $permission[1] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <br>
                                <input type="submit" class="btn btn-block btn-outline-success" value="Add Permission">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Permissions</h5>
                </div>
                <div class="card-body">
                    <table id="user_permissions_table" class="table table-striped table-bordered" style="width:100%"  data-userid="<?= $user->getUserId() ?>">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Permission Name</th>
                            <th>Permission Description</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Permission Name</th>
                            <th>Permission Description</th>
                            <th>Status</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>