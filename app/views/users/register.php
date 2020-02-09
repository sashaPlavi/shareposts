<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-linght mt-5">
            <h2 class='text-center'>Create An Account</h2>
            <p>please fill out this form to register with us</p>
            <form action="<?php echo URLROOT; ?>/users/register" method="POST">
                <div class="form-group">
                    <label for="name">Name: <sup>*</sup></label>
                    <input type="text" name="name" class="form-control form-control-lg <?php echo (!empty($data['name_err'])) ? 'is_invalid' : ''; ?>" value="<?php echo $data['name']; ?>">
                    <span class="text-danger"><?php echo $data['name_err']; ?></span>
                </div>
                <div class="form-group">
                    <label for="email">Email: <sup>*</sup></label>
                    <input type="email" name="email" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is_invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
                    <span class="text-danger"><?php echo $data['email_err']; ?></span>
                </div>
                <div class="form-group">
                    <label for="password">Password: <sup>*</sup></label>
                    <input type="password" name="password" class="form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is_invalid' : ''; ?>" value="<?php echo $data['password']; ?>">
                    <span class="text-danger"><?php echo $data['password_err']; ?></span>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm password: <sup>*</sup></label>
                    <input type="password" name="confirm_password" class="form-control form-control-lg <?php echo (!empty($data['confirm_password_err'])) ? 'is_invalid' : ''; ?>" value="<?php echo $data['confirm_password']; ?>">
                    <span class="text-danger"><?php echo $data['confirm_password_err']; ?> </span>

                </div>

                <div class="row">
                    <div class="col">
                        <input type="submit" value="Register" class="btn btn-success btn-block">
                    </div>
                    <div class="col">
                        <a href="<?php echo URLROOT; ?>/users/login" class="btn btn-light btn-block">Have an account? login</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>