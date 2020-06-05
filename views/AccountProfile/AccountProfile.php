<?php
    $params = $_SESSION['params'];
    /** @var src\Models\UserModel\UserModel $user */
    $user = $params['user'];
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
                    <?php if ($user->getStatus() === 1): ?>
                        <a class="btn btn-block btn-outline-danger" href="/admin/account/disable/<?= $user->getUserId() ?>">Disable User</a>
                    <?php elseif ($user->getStatus() === 0): ?>
                        <a class="btn btn-block btn-outline-success" href="/admin/account/enable/<?= $user->getUserId() ?>">Enable User</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Noch nicht bekannt</h5>
                </div>
                <div class="card-body"></div>
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