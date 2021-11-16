<?php !isAdmin() ? redirect('login') : '' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/x-icon" sizes="16x16" href="<?= base_url('assets/images/favicon.ico') ?>">
    <title>Admin ZocmodZ</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?= base_url('assets/bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/plugins/bower_components/datatables/media/css/dataTables.bootstrap.css') ?>" rel="stylesheet" type="text/css" />
    <!-- Menu CSS -->
    <link href="<?= base_url('assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css') ?>" rel="stylesheet">
    <!-- animation CSS -->
    <link href="<?= base_url('assets/css/animate.css') ?>" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
    <!-- color CSS -->
    <link href="<?= base_url('assets/css/colors/megna-dark.css') ?>" id="theme" rel="stylesheet">
    <!--alerts CSS -->
    <link href="<?= base_url('assets/plugins/bower_components/sweetalert/sweetalert.css') ?>" rel="stylesheet" type="text/css">
    <!-- toast CSS -->
    <link href="<?= base_url('assets/plugins/bower_components/toast-master/css/jquery.toast.css') ?>" rel="stylesheet">
    
    <!-- jQuery -->
    <script src="<?= base_url('assets/plugins/bower_components/jquery/dist/jquery.min.js') ?>"></script>
</head>

<body class="fix-header">

    <!-- Preloader -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <!-- /Preloader -->


    <!-- Wrapper -->
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">
                <div class="top-left-part">
                    <!-- Logo -->
                    <a class="logo" href="<?= base_url()?>">
                        <b>
                            <img src="<?= base_url('assets/plugins/images/admin-logo.png') ?>" alt="home" class="dark-logo" />
                            <img src="<?= base_url('assets/images/admin-logo-dark.png') ?>" alt="home" class="light-logo" />
                        </b>
                        <span class="hidden-xs">
                            <img src="<?= base_url('assets/plugins/images/admin-text.png') ?>" alt="home" class="dark-logo" />
                            <img src="<?= base_url('assets/plugins/images/admin-text-dark.png') ?>" alt="home" class="light-logo" />
                        </span> </a>
                </div>
                <!-- /Logo -->

                <!-- Toggle icon -->
                <ul class="nav navbar-top-links navbar-left">
                    <li><a href="javascript:void(0)" class="open-close waves-effect waves-light"><i class="ti-menu"></i></a></li>
                    <li><a href="<?= base_url('order')?>" class="waves-effect waves-light"><i class="mdi mdi-cart-outline fa-fw"></i><sup class="cart">4</sup></a></li>                    
                </ul>
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <!-- alert area     -->
                    <li>
                        <?php if ($this->session->flashdata('success')) : ?>
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <?= $this->session->flashdata('success'); ?>
                            </div>
                            <?php $this->session->unset_userdata('success'); ?>
                        <?php endif; ?>
                        <?php if ($this->session->flashdata('error')) : ?>
                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <?= $this->session->flashdata('error'); ?>
                            </div>
                            <?php $this->session->unset_userdata('error'); ?>
                        <?php endif; ?>
                    </li>


                    <li class="dropdown">
                        <a class="dropdown-toggle profile-pic" data-toggle="dropdown"><b class="hidden-xs"><?= $this->session->userdata('name') ?></b><span class="caret"></span> </a>
                        <ul class="dropdown-menu dropdown-user animated flipInY">
                            <li>
                                <div class="dw-user-box">
                                    <div class="u-img"><img src="<?= base_url('assets/images/admin-logo.png') ?>" alt="user" /></div>
                                    <div class="u-text">
                                        <h4><?= $this->session->userdata('name') ?></h4>
                                        <p class="text-muted"><?= $this->session->userdata('email') ?></p>
                                        <a href="profile.html" class="btn btn-rounded btn-danger btn-sm">View Profile</a>
                                    </div>
                                </div>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#"><i class="ti-user"></i> My Profile</a></li>
                            <li><a href="#"><i class="ti-wallet"></i> My Balance</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="javascript:void(0)" class="logout"><i class="fa fa-power-off"></i> Logout</a></li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
        <!-- End Top Navigation -->

        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav slimscrollsidebar">
                <div class="sidebar-head">
                    <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span class="hide-menu">Navigation</span></h3>
                </div>
                <ul class="nav" id="side-menu">
                    <li><a href="<?= base_url('dashboard') ?>" class="waves-effect"><i class="mdi mdi-av-timer fa-fw"></i> <span class="hide-menu">Dashboard</span></a></li>
                    <li><a href="<?= base_url('bike') ?>" class="waves-effect"><i class="mdi mdi-bike fa-fw"></i> <span class="hide-menu">Bike</span></a></li>
                    <li><a href="<?= base_url('category') ?>" class="waves-effect"><i class="mdi mdi-format-indent-increase fa-fw"></i> <span class="hide-menu">Category</span></a></li>
                    <li><a href="<?= base_url('subcategory') ?>" class="waves-effect"><i class="mdi mdi-format-indent-increase fa-fw"></i> <span class="hide-menu">Subcategory</span></a></li>
                    <li><a href="<?= base_url('product') ?>" class="waves-effect"><i class="mdi mdi-ticket-percent fa-fw"></i> <span class="hide-menu">Product</span></a></li>
                    <li><a href="<?= base_url('banner') ?>" class="waves-effect"><i class="mdi mdi-folder-multiple-image fa-fw"></i> <span class="hide-menu">Banner</span></a></li>
                    <li><a href="javascript:void(0)" class="waves-effect logout"><i class="mdi mdi-logout fa-fw"></i> <span class="hide-menu">Log out</span></a></li>
                    <li class="devider"></li>
                </ul>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Left Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <!-- Logout -->
