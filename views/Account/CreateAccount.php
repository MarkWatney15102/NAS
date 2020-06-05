<div class="container-fluid">
    <form action="/account/form/create" method="post">
        <input type="hidden" name="backUrl" value="http://<?= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Login Data</h5>
                    </div>
                    <div class="card-body">
                        <label for="login_name">Login Name</label>
                        <input type="text" class="form-control" name="login_name" placeholder="Login Name">
                        <label for="reg_mail">E-Mail</label>
                        <input type="email" class="form-control" name="reg_mail" placeholder="E-Mail">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        <label for="password_repeat">Repeat Password</label>
                        <input type="password" class="form-control" name="password_repeat" placeholder="Repeat Password">
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Personal Data</h5>
                    </div>
                    <div class="card-body">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" name="first_name" placeholder="First Name">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" name="last_name" placeholder="Last Name">
                    </div>
                </div>
            </div>
        </div>
        <input type="submit" class="btn btn-block btn-outline-success" value="Create Account">
    </form>
</div>