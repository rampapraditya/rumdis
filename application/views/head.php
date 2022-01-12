<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <title>SI RUMDIS</title>
        <!-- General CSS Files -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <!-- CSS Libraries -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/jqvmap/dist/jqvmap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/summernote/summernote-bs4.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css">
        <!-- Template CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/components.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/datatables/datatables.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">
        <!-- Toast -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/izitoast/css/iziToast.min.css">
        <script src="<?php echo base_url(); ?>assets/js/jquery-3.3.1.min.js"></script>


        <!-- maps -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/maps/leaflet.css">
        <script type="text/javascript" src="<?php echo base_url() ?>assets/maps/leaflet.js"></script>

        <style>
            .modal {
                overflow-y:auto;
            }
        </style>
    </head>
    <body>
        <div id="app">
            <div class="main-wrapper">
                <div class="navbar-bg"></div>
                <nav class="navbar navbar-expand-lg main-navbar">
                    <form class="form-inline mr-auto">
                        <ul class="navbar-nav mr-3">
                            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                        </ul>
                    </form>
                    <ul class="navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <?php
                                $def = base_url() . 'assets/img/avatar.png';
                                $foto = $this->Mglobals->getAllQR("select foto from userslogin where iduserslogin = '" . $username . "';")->foto;
                                if (strlen($foto) > 0) {
                                    if (file_exists($foto)) {
                                        $def = base_url() . substr($foto, 2);
                                    }
                                }
                                ?>
                                <img alt="image" src="<?php echo $def; ?>" class="rounded-circle mr-1">
                                <div class="d-sm-none d-lg-inline-block"><?php echo $nama; ?></div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <?php
                                if($this->session->userdata('logged')){
                                    ?>
                                <a href="<?php echo base_url(); ?>changepass" class="dropdown-item has-icon">
                                    <i class="far fa-eye"></i> Ganti Password
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="<?php echo base_url(); ?>login/logout" class="dropdown-item has-icon text-danger">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </a>
                                    <?php
                                }else if($this->session->userdata('loggeduser')){
                                    ?>
                                <a href="<?php echo base_url(); ?>profileuser" class="dropdown-item has-icon">
                                    <i class="far fa-user"></i> Profile
                                </a>
                                <a href="<?php echo base_url(); ?>changepassuser" class="dropdown-item has-icon">
                                    <i class="far fa-eye"></i> Ganti Password
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="<?php echo base_url(); ?>login/logout" class="dropdown-item has-icon text-danger">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </a>
                                    <?php
                                }
                                ?>
                            </div>
                        </li>
                    </ul>
                </nav>