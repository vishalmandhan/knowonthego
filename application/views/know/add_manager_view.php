<!-- ============================================================== -->
<!-- Container fluid   Add Shop Manager -->
<!-- ============================================================== -->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <?php
                if (isset($db_error)) {
                    echo '<div class="alert alert-danger alert">' . $db_error . '</div>';
                } elseif (isset($db_success)) {
                    echo '<div class="alert alert-success">' . $db_success . '</div>';
                }
                ?>

                <div class="m-t-25 m-b--5 align-center">
                    <?php echo validation_errors(); ?>
                    <?php if($this->session->flashdata('error')){
                        ?><div class="alert alert-danger"><?php echo ($this->session->flashdata('error')); ?></div><?php
                    } ?>
                </div>

                <?php echo form_open('user_cont/add_manager', 'class="form-horizontal"') ?>
                <!-- <form class="form-horizontal" method="post"> -->
                <div class="card-body">
                    <h4 class="card-title">Create User Account</h4>
                    <div class="form-group row">
<!--                        <label for="name" class="col-sm-3 text-right control-label col-form-label">Id</label>-->
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="userid" placeholder="User Id" hidden>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 text-right control-label col-form-label">Full Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="name" placeholder="Enter Name" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="username" class="col-sm-3 text-right control-label col-form-label">Username</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="username" placeholder="Enter Username" required pattern="^[a-z\d\.]{5,}$" title="Username should only contain lowercase letters. e.g. akshay">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-3 text-right control-label col-form-label">Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="password" placeholder="Enter Password" required
                                   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-sm-3 text-right control-label col-form-label">Confirm Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="confirm_password" placeholder="Enter Password" required
                                   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-3 text-right control-label col-form-label">Email Address</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" name="email" placeholder="Enter Email Address" required >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="select user" class="col-sm-3 text-right control-label col-form-label">Select
                            Type</label>
                        <div class="col-sm-9">
                            <select name="user_type" class="form-control" required>
                                <option value="">Select Type</option>
                                <?php foreach ($user_types as $user_type) { ?>
                                    <option value="<?= $user_type['user_type_id'] ?>"><?= $user_type['user_type'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-sm-3 text-right control-label col-form-label">Status</label>
                        <div class="checkbox">
                            <input type="checkbox" checked="checked" name="status">
                        </div>
                    </div>
                </div>
                <div class="border-top">
                    <div class="card-body">
                        <button type="submit" name="btn_submit" class="btn btn-success">Submit</button>
                        <a href="<?php echo site_url(); ?>/dashboard_cont/dashboard">
                            <button type="button" name="btn_cancel" class="btn btn-default">Cancel</button>
                        </a>

                    </div>
                </div>
                <!-- </form> -->
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
