<?php
    $params = $_SESSION['params'];
    $accounts = $params['accounts'];
?>
<div class="container-fluid">
    <div class="col-lg-12">
        <table class="table table-dark">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Username</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($accounts as $account) {
                    ?>
                        <tr>
                            <td><?= $account['id'] ?></td>
                            <td><?= $account['username'] ?></td>
                            <td><?= $account['firstname'] ?></td>
                            <td><?= $account['lastname'] ?></td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-outline-info dropdown-toggle" href="#" role="button" id="accountActions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="accountActions">
                                        <a class="dropdown-item" href="/admin/account/<?= $account['id'] ?>">View Profile</a>
                                        <?php if ((int)$account['active'] !== 0) { ?>
                                            <a class="dropdown-item" href="/admin/account/disable/<?= $account['id'] ?>">Disable User</a>
                                        <?php } else { ?>
                                            <a class="dropdown-item" href="/admin/account/enable/<?= $account['id'] ?>">Enable User</a>
                                        <?php } ?>
                                        <a class="dropdown-item" href="#">Delete User</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>