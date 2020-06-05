<?php
    $params = $_SESSION['params'];
    $dev = $params['dev'];
    $sysInfo = $params['sysInfo'];
?>
<div class="container-fluid">
    <?php if ((int)$dev === 1): ?>
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">User Information</h5>
                    </div>
                    <div class="card-body"></div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">System Information</h5>
                    </div>
                    <div class="card-body">
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Logs</h5>
                    </div>
                    <div class="card-body"></div>
                </div>
            </div>
        </div>
    <?php else: ?>
    <?php endif; ?>
</div>