<?php
use src\Service\CurrentUser\CurrentUser;
?>
<nav class="navbar navbar-expand-lg navbar-light nav-bar">
    <a class="navbar-brand" href="/home">Navbar</a>
    <ul class="navbar-nav mr-auto">
        <?php if ($loggedIn) { ?>
            <li class="nav-item active">
                <a class="nav-link" href="/home">Home <span class="sr-only">(current)</span></a>
            </li>
        <?php } else { ?>
            <li class="nav-item active">
                <a class="nav-link" href="/login">Login <span class="sr-only">(current)</span></a>
            </li>
        <?php } ?>
        <?php if ($loggedIn) { ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" param="navbarDropdown" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    Admin Functions
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/admin/accountlist">Account List</a>
                </div>
            </li>
            <?php if (CurrentUser::get()->getDev()): ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" param="navbarDropdown" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    Systemadmin
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <div class="col-lg-12" style="text-align: center">
                        Database Name
                        <br>
                        <br>
                        <hr>
                        PHP Version
                        <br>
                        <?= PHP_VERSION ?>
                        <hr>
                        Version
                        <br>
                        <?= VERSION ?>
                    </div>
                </div>
            </li>
            <?php endif; ?>
            <li class="nav-item active">
                <a class="nav-link" href="/logout">Logout</a>
            </li>
        <?php } ?>
    </ul>
</nav>