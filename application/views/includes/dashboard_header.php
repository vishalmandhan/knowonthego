<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>assets/images/favicon.png">
    <title>Dashboard</title>
    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>assets/libs/flot/css/float-chart.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/libs/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet"/>
    <link href="<?php echo base_url(); ?>assets/extra-libs/calendar/calendar.css" rel="stylesheet"/>
    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>assets/dist/css/style.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <script src="<?php echo base_url();?>assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

    <!--[if lt IE 9]>

    <![endif]-->
</head>

<body>

<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <header class="topbar" data-navbarbg="skin5">
        <nav class="navbar top-navbar navbar-expand-md navbar-dark">
            <div class="navbar-header" data-logobg="skin5">
                <!-- This is for the sidebar toggle which is visible on mobile only -->
                <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <a class="navbar-brand" href="#">
                    <!-- Logo icon -->
                    <b class="logo-icon p-l-10">
                        <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                        <!-- Dark Logo icon -->
                        <img src="<?php echo base_url(); ?>assets/images/logoicon.png" alt="" class="light-logo"/>

                    </b>
                    <!--End Logo icon -->
                    <!-- Logo text -->
                    <span class="logo-text">
                         <!-- dark Logo text -->
                         <img src="<?php echo base_url(); ?>assets/images/logotext.png" alt="" class="light-logo"/>

                     </span>
                </a>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Toggle which is visible on mobile only -->
                <!-- ============================================================== -->
                <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                   data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                   aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
            </div>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                <!-- ============================================================== -->
                <!-- toggle and nav items -->
                <!-- ============================================================== -->
                <ul class="navbar-nav float-left mr-auto">
                    <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light"
                                                              href="javascript:void(0)" data-sidebartype="mini-sidebar"><i
                                    class="mdi mdi-menu font-24"></i></a></li>

                </ul>
                <!-- ============================================================== -->
                <!-- Right side toggle and nav items -->
                <!-- ============================================================== -->
                <ul class="navbar-nav float-right">
                    <!-- ============================================================== -->
                    <!-- Comment -->
                    <!-- ============================================================== -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-bell font-24"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">New Mail Received</a>
                            <a class="dropdown-item" href="#">Outfitters Posted</a>
                            <!--                            <div class="dropdown-divider"></div>-->
                            <a class="dropdown-item" href="#">Bonanza Location Updated</a>
                        </div>
                    </li>
                    <!-- ============================================================== -->
                    <!-- End Comment -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Messages -->
                    <!-- ============================================================== -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" id="2"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i
                                    class="font-24 mdi mdi-comment-processing"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown"
                             aria-labelledby="2">

                            <ul class="list-style-none">
                                <li>
                                    <div class="">
                                        <!-- Message -->
                                        <a href="javascript:void(0)" class="link border-top">
                                            <div class="d-flex no-block align-items-center p-10">
                                                <span class="btn btn-success btn-circle"><i
                                                            class="ti-calendar"></i></span>
                                                <div class="m-l-10">
                                                    <h5 class="m-b-0">Event today</h5>
                                                    <span class="mail-desc">Just a reminder that event</span>
                                                </div>
                                            </div>
                                        </a>
                                        <!-- Message -->
                                        <a href="javascript:void(0)" class="link border-top">
                                            <div class="d-flex no-block align-items-center p-10">
                                                <span class="btn btn-info btn-circle"><i class="ti-settings"></i></span>
                                                <div class="m-l-10">
                                                    <h5 class="m-b-0">Settings</h5>
                                                    <span class="mail-desc">You can customize</span>
                                                </div>
                                            </div>
                                        </a>
                                        <!-- Message -->
                                        <a href="javascript:void(0)" class="link border-top">
                                            <div class="d-flex no-block align-items-center p-10">
                                                <span class="btn btn-primary btn-circle"><i class="ti-user"></i></span>
                                                <div class="m-l-10">
                                                    <h5 class="m-b-0">A.A</h5>
                                                    <span class="mail-desc">Just see the my admin!</span>
                                                </div>
                                            </div>
                                        </a>
                                        <!-- Message -->
                                        <a href="javascript:void(0)" class="link border-top">
                                            <div class="d-flex no-block align-items-center p-10">
                                                <span class="btn btn-danger btn-circle"><i
                                                            class="fa fa-link"></i></span>
                                                <div class="m-l-10">
                                                    <h5 class="m-b-0">Luanch Admin</h5>
                                                    <span class="mail-desc">Just see the my new admin!</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- ============================================================== -->
                    <!-- End Messages -->
                    <!-- ============================================================== -->

                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->


                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href=""
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                            <strong><?= $session_data['full_name'] ?> &nbsp; </strong><img
                                    src="<?php echo base_url(); ?>assets/images/users/1.jpg" alt="user"
                                    class="rounded-circle" width="31"></a>
                        <div class="dropdown-menu dropdown-menu-right user-dd animated">
                            <a class="dropdown-item" href="javascript:void(0)"><i class="ti-user m-r-5 m-l-5"></i> My
                                Profile</a>

                            <a class="dropdown-item" href="javascript:void(0)"><i class="ti-email m-r-5 m-l-5"></i>
                                Inbox</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?php echo site_url(); ?>/login_cont/change_password"><i
                                        class="ti-settings m-r-5 m-l-5"></i> Change
                                Password</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?php echo site_url(); ?>/login_cont/logout"><i
                                        class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
                        </div>
                    </li>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                </ul>
            </div>
        </nav>
    </header>
    <!-- ============================================================== -->
    <!-- End Topbar header -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->

    <aside class="left-sidebar" data-sidebarbg="skin5">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav">
                <ul id="sidebarnav" class="p-t-30">
                    <li class="sidebar-item"><a class="sidebar-link waves-effect waves-dark sidebar-link"
                                                href="<?php echo site_url(); ?>/dashboard_cont/dashboard"
                                                aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span
                                    class="hide-menu">Dashboard</span></a></li>
                    <?php if ($session_data['is_admin']) { ?>
                        <li class="sidebar-item"><a class="sidebar-link has-arrow waves-effect waves-dark"
                                                    href="javascript:void(0)" aria-expanded="false"><i
                                        class="mdi mdi-account-circle"></i><span class="hide-menu">Shop User </span></a>

                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="<?php echo site_url(); ?>/user_cont/add_manager"
                                                            class="sidebar-link"><i
                                                class="mdi mdi-note-outline"></i><span
                                                class="hide-menu"> Add User </span></a></li>
                                <li class="sidebar-item"><a href="<?php echo site_url(); ?>/user_cont/view_manager"
                                                            class="sidebar-link"><i
                                                class="mdi mdi-note-outline"></i><span
                                                class="hide-menu"> View User </span></a>
                                </li>

                            </ul>
                        </li>
                    <?php } ?>
                    <li class="sidebar-item"><a class="sidebar-link has-arrow waves-effect waves-dark"
                                                href="javascript:void(0)" aria-expanded="false"><i
                                    class="mdi mdi-store"></i><span class="hide-menu">Shop </span></a>

                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="<?php echo site_url(); ?>/shop_cont/add_shop"
                                                        class="sidebar-link"><i class="mdi mdi-note-outline"></i><span
                                            class="hide-menu"> Add Shop </span></a></li>
                            <li class="sidebar-item"><a href="<?php echo site_url(); ?>/shop_cont/view_shops"
                                                        class="sidebar-link"><i
                                            class="mdi mdi-note-outline"></i><span
                                            class="hide-menu"> View Shop</span></a>
                            </li>

                        </ul>
                    </li>

                    <li class="sidebar-item"><a class="sidebar-link has-arrow waves-effect waves-dark"
                                                href="javascript:void(0)" aria-expanded="false"><i
                                    class="mdi mdi-cart"></i><span class="hide-menu">Products </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="<?php echo site_url(); ?>/product_cont/add_product"
                                                        class="sidebar-link"><i
                                            class="mdi mdi-note-outline"></i><span
                                            class="hide-menu"> Add Product </span></a></li>
                            <li class="sidebar-item"><a href="<?php echo site_url(); ?>/product_cont/view_products"
                                                        class="sidebar-link"><i
                                            class="mdi mdi-note-outline"></i><span
                                            class="hide-menu"> View Product </span></a></li>
                        </ul>
                    </li>
                    <li class="sidebar-item"><a class="sidebar-link has-arrow waves-effect waves-dark"
                                                href="javascript:void(0)" aria-expanded="false"><i
                                    class="mdi mdi-bell-plus"></i><span class="hide-menu">Promotion </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="<?php echo site_url(); ?>/promotion_cont/add_promotion"
                                                        class="sidebar-link"><i
                                            class="mdi mdi-note-outline"></i><span
                                            class="hide-menu"> Add Promotion </span></a></li>
                            <li class="sidebar-item"><a href="<?php echo site_url(); ?>/promotion_cont/view_promotions"
                                                        class="sidebar-link"><i
                                            class="mdi mdi-note-outline"></i><span
                                            class="hide-menu"> View Promotion </span></a></li>
                        </ul>
                    </li>
                    <li class="sidebar-item"><a class="sidebar-link has-arrow waves-effect waves-dark"
                                                href="javascript:void(0)" aria-expanded="false"><i
                                    class="mdi mdi-map-marker"></i><span class="hide-menu"> Shop Location </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a
                                        href="<?php echo site_url(); ?>/shop_cont/view_shop_location"
                                        class="sidebar-link"><i
                                            class="mdi mdi-note-outline"></i><span class="hide-menu"> View Shops Location </span></a>
                            </li>
                            <!--                            <li class="sidebar-item"><a href="-->
                            <?php //echo site_url(); ?><!--/dashboard_cont/view_all_shops_locations" class="sidebar-link"><i-->
                            <!--                                            class="mdi mdi-note-outline"></i><span-->
                            <!--                                            class="hide-menu"> View All Shops </span></a></li>-->
                        </ul>
                    </li>
                    <?php if ($session_data['is_admin']) { ?>
                    <li class="sidebar-item"><a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                                    class="mdi mdi-account-multiple"></i><span class="hide-menu">Customer Detail </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="<?php echo site_url(); ?>/customer_cont/view_customer"
                                                        class="sidebar-link"><i
                                            class="mdi mdi-note-outline"></i><span
                                            class="hide-menu"> View Customers </span></a></li>
                            <li class="sidebar-item"><a href="<?php echo site_url(); ?>/customer_cont/view_customer_location"
                                                        class="sidebar-link"><i
                                            class="mdi mdi-note-outline"></i><span
                                            class="hide-menu">Customers Location </span></a></li>
                            <li class="sidebar-item"><a href="<?php echo site_url(); ?>/customer_cont/view_customer_subscription"
                                                        class="sidebar-link"><i
                                            class="mdi mdi-note-outline"></i><span
                                            class="hide-menu">Customers Subscription </span></a></li>
                        </ul>
                    </li>
                    <?php } ?>

                    <li class="sidebar-item"><a href="<?php echo site_url(); ?>/dashboard_cont/calendar"
                                                class="sidebar-link"><i class="mdi mdi-calendar-check"></i><span
                                    class="hide-menu"> Calendar </span></a></li>


                </ul>
            </nav>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
    </aside>
    <!-- ============================================================== -->
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
<!--                    <h4 class="page-title">Dashboard</h4>-->

                </div>
            </div>
        </div>

