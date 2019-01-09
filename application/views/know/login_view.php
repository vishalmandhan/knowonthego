<!DOCTYPE html>
<html dir="ltr">

<head>
    <title>KNOW-On The Go</title>
    <link href="<?php echo base_url(); ?>assets/dist/css/style.min.css" rel="stylesheet" type="text/css">
</head>

<body>

<div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
    <div class="auth-box bg-dark border-top border-secondary">
        <div id="loginform">
            <div class="text-center p-t-20 p-b-20">
                <span class="db"><img src="<?php echo base_url(); ?>assets/images/logotext.png" alt="logo"/></span>
            </div>

            <div class="m-t-25 m-b--5 align-center">
            <?php if (isset($_SESSION['error'])) {
                echo '<div class="alert alert-danger">' . $this->session->flashdata("error") . '</div>';
            }
            ?>
            </div>

            <!-- Form -->
            <?php echo form_open('login_cont/login', 'class="form-horizontal" id="loginform"') ?>

            <div class="row p-b-30">
                <div class="col-12">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                                <span class="input-group-text bg-success text-white" id="basic-addon1"><i
                                            class="ti-user"></i></span>
                        </div>
                        <input type="text" class="form-control form-control-lg" placeholder="Username"
                               aria-label="Username" aria-describedby="basic-addon1" required="" name="username">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                                <span class="input-group-text bg-warning text-white" id="basic-addon2"><i
                                            class="ti-pencil"></i></span>
                        </div>
                        <input type="password" class="form-control form-control-lg" placeholder="Password"
                               aria-label="Password" aria-describedby="basic-addon1" required="" name="password">
                    </div>
                </div>
            </div>
            <div class="row border-top border-secondary">
                <div class="col-12">
                    <div class="form-group">
                        <div class="p-t-20">
                            <a href="<?php echo site_url(); ?>/home_cont/index">
                                <button class="btn btn-info" id="to-recover" type="button">Back To Home
                                </button>
                            </a>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="<?php echo site_url(); ?>/login_cont/forgotPassword">
                                <button class="btn btn-warning" id="to-recover" type="button">Forgot password?
                                </button>
                            </a>
                            <button class="btn btn-success float-right" name="btnLogin" type="submit">Login</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>

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
            }, 2000);

            $('[data-toggle="tooltip"]').tooltip();
            $(".preloader").fadeOut();
            // ==============================================================
            // Login and Recover Password
            // ==============================================================
            $('#to-recover').on("click", function () {
                $("#loginform").slideUp();
                $("#recoverform").fadeIn();
            });
            $('#to-login').click(function () {

                $("#recoverform").hide();
                $("#loginform").fadeIn();
            });
        </script>

</body>

</html>