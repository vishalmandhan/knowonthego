<!DOCTYPE html>
<head>
    <title>KNOW-On The Go</title>
    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>assets/dist/css/style.min.css" rel="stylesheet">
</head>

<body>

<div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
    <div class="auth-box bg-dark border-top border-secondary">
        <div id="loginform">
            <div class="text-center p-t-20 p-b-20">
                <span class="db"><img src="<?php echo base_url(); ?>assets/images/logotext.png" alt="logo"/></span>
                <br/><br/>
            </div>

            <div class="m-t-25 m-b--5 align-center">
                <?php if ($this->session->flashdata('error')) {
                    ?>
                    <div class="alert alert-danger"><?php echo($this->session->flashdata('error')); ?></div><?php
                } ?>

            </div>
            <div class="m-t-25 m-b--5 align-center">
                <?php if ($this->session->flashdata('success')) {
                    ?>
                    <div class="alert alert-success"><?php echo($this->session->flashdata('success')); ?></div><?php
                } ?>
            </div>

            <!-- Form -->
            <?php echo form_open('login_cont/resetPassword', 'class="form-horizontal" ') ?>
            <!--                    <form class="col-12" method="post">-->
            <!-- email -->
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-danger text-white" id="basic-addon1"><i
                                class="ti-email"></i></span>
                </div>
                <input type="text" class="form-control form-control-lg" placeholder="Email Address"
                       aria-label="Username" aria-describedby="basic-addon1" name="email">
            </div>
            <!-- pwd -->
            <div class="row m-t-20 p-t-20 border-top border-secondary">
                <div class="col-6">
                    <br>
                    <a href="<?php echo site_url(); ?>/login_cont/login">
                        <button class="btn btn-info float-left" name="btnLogin" type="button">Back To Login</button>
                    </a>
                </div>

                <div class="col-6">
                    <br>
                    <button class="btn btn-success float-right" name="btnLogin" type="submit">Recover</button>
                </div>
            </div>
            <?php echo form_close(); ?>

            <!--                        </form>-->
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