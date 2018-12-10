<!DOCTYPE html>
<html dir="ltr">

<head>
    <title>KNOW-On The Go</title>
    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>assets/dist/css/style.min.css" rel="stylesheet">
</head>

<body>
<div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
    <div class="auth-box bg-dark border-top border-secondary">
        <div>
            <div class="text-center p-t-20 p-b-20">
                <span class="db"><img src="<?php echo base_url(); ?>assets/images/logotext.png" alt="logo"/></span>
            </div>

            <div class="m-t-25 m-b--5 align-center">
                <?php if($this->session->flashdata('success')){
                    ?><div class="alert alert-success"><?php echo ($this->session->flashdata('success')); ?></div><?php
                } ?>
            </div>

            <div class="m-t-25 m-b--5 align-center">
                <?php if($this->session->flashdata('error')){
                    ?><div class="alert alert-danger"><?php echo ($this->session->flashdata('error')); ?></div><?php
                } ?>
            </div>

            <div class="m-t-25 m-b--5 align-center">
                <?php if($this->session->flashdata('match_error')){
                    ?><div class="alert alert-danger"><?php echo ($this->session->flashdata('match_error')); ?></div><?php
                } ?>
            </div>

            <!-- Form -->
            <?php echo form_open('login_cont/change_password', 'class="form-horizontal"') ?>
            <!--            <form class="form-horizontal m-t-20" method="post">-->
            <div class="row p-b-30">
                <div class="col-12">
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                                <span class="input-group-text bg-warning text-white" id="basic-addon2"><i
                                            class="ti-pencil"></i></span>
                        </div>
                        <input type="password" class="form-control form-control-lg" placeholder=" Old Password"
                               aria-label="Password" aria-describedby="basic-addon1" name="old_password" required>
                    </div>
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                                <span class="input-group-text bg-info text-white" id="basic-addon2"><i
                                            class="ti-pencil"></i></span>
                        </div>
                        <input type="Password" class="form-control form-control-lg" placeholder=" New Password"
                               aria-label="Password" aria-describedby="basic-addon1" name="new_password" required>
                    </div>
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                                <span class="input-group-text bg-info text-white" id="basic-addon2"><i
                                            class="ti-pencil"></i></span>
                        </div>
                        <input type="Password" class="form-control form-control-lg" placeholder=" Confirm Password"
                               aria-label="Password" aria-describedby="basic-addon1"
                               name="confirm_password" required>
                    </div>
                </div>
            </div>
            <div class="row border-top border-secondary">
                <div class="col-12">
                    <div class="form-group">
                        <div class="p-t-20">
                            <button class="btn btn-block btn-lg btn-info" name="btn_submit" type="submit">Submit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row border-top border-secondary">
                <div class="col-12">
                    <div class="form-group">
                        <div class="p-t-20">
                           <a href="<?php echo site_url(); ?>/dashboard_cont/dashboard"> <button class="btn btn-block btn-lg btn-success" name="btn_dashboard" type="button">Back To Dashboard
                            </button></a>
                        </div>
                    </div>
                </div>
            </div>
            <!--            </form>-->
            <?php echo form_close(); ?>


        </div>
    </div>
</div>
</div>
<!-- ============================================================== -->
<!-- All Required js -->
<!-- ============================================================== -->
<script src="<?php echo base_url(); ?>assets/libs/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="<?php echo base_url(); ?>assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- ============================================================== -->
<!-- This page plugin js -->
<!-- ============================================================== -->
<script>
    window.setTimeout(function () {
        $(".alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 3000);

    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
</script>
</body>

</html>