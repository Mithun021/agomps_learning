<?php
date_default_timezone_set('Asia/Kolkata');
// echo date('Y-m-d H:i:s'); 
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>AGOMPS INDIA</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="AGOMPS INDIA" name="description" />
        <meta content="AGOMPS INDIA" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="<?= base_url() ?>public/assets/images/favicon.png">

        <!-- App css -->
        <link href="<?= base_url() ?>public/assets/css/bootstrap.mins.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>public/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>public/assets/css/theme.min.css" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
        <style>
            @media (min-width: 992px) { /* LG and above */
                .topnav {
                    background-color: #ff6700 !important;
                }
                .navbar-light .navbar-nav .show>.nav-link, .navbar-light .navbar-nav .active>.nav-link, .navbar-light .navbar-nav .nav-link.show, .navbar-light .navbar-nav .nav-link.active {
                    color: #ffffff;
                }
                .topnav .navbar-nav .nav-link{
                    color: #ffffff;
                }
                .topnav .navbar-nav .nav-link i {
                    background-color: #000;
                }
            }

            @media (max-width: 991px) { /* Below LG */
                .topnav {
                    background-color: transparent !important;
                }
            }
            .card-header{
                background-color: #ffffff;
                border-bottom: 2px solid #ff6700 !important;
            }
            .card-header .card-title{
                margin: 0;
                font-size: 18px;
                text-transform: uppercase;
                color: #ff6700;
            }

            /* Initially hide navigation buttons */
            .swiper-pagination {
                display: none;
            }

            /* Show navigation buttons only on mobile (max-width: 640px) */
            @media (max-width: 640px) {
                .swiper-pagination {
                    display: block;
                }
            }

        </style>
    </head>

    <?php
        $customer_ac_id = session()->get('customer_ac_id');
    ?>

    <body>

        <!-- Begin page -->
        <div id="layout-wrapper">

            <div class="main-content">

                <header id="page-topbar">
                    <div class="navbar-header">
                        <!-- LOGO -->
                        <div class="navbar-brand-box d-flex align-items-left">
                            <a href="<?= base_url() ?>" class="logo">
                                <!-- <i class="mdi mdi-album"></i> -->
                                <span>
                                    <img src="<?= base_url() ?>public/assets/images/logo-main.png" alt="">
                                </span>
                            </a>

                            <button type="button" class="btn btn-sm mr-2 font-size-16 d-lg-none header-item waves-effect waves-light" data-toggle="collapse" data-target="#topnav-menu-content">
                                <i class="fa fa-fw fa-bars"></i>
                            </button>
                        </div>
        
                        <div class="d-flex align-items-center">
        
                            <!-- <div class="dropdown d-inline-block ml-2">
                                <button type="button" class="btn header-item noti-icon waves-effect waves-light" id="page-header-search-dropdown"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="mdi mdi-magnify"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                                    aria-labelledby="page-header-search-dropdown">
                                    
                                    <form class="p-3">
                                        <div class="form-group m-0">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div> -->
        
                            
        
                            
        
                            <div class="dropdown d-inline-block ml-2">
                                <button type="button" class="btn header-item waves-effect waves-light"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img class="rounded-circle header-profile-user" src="<?= base_url() ?>public/assets/images/users/user.png"
                                        alt="Header Avatar">
                                    <span class="d-none d-sm-inline-block ml-1"><?= isset($customer_ac_id) ? $customer_ac_id : '' ?></span>
                                    <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <?php if(isset($customer_ac_id)){ ?>
                                        <a class="dropdown-item d-flex align-items-center justify-content-between" href="<?= base_url() ?>logout">
                                            <span>Logout</span>
                                        </a>
                                    <?php }else{ ?>
                                        <a class="dropdown-item d-flex align-items-center justify-content-between" href="<?= base_url() ?>user-login">
                                        Login
                                        </a>
                                        <a class="dropdown-item d-flex align-items-center justify-content-between" href="<?= base_url() ?>user-register">
                                            <span>Register</span>
                                        </a>
                                    <?php } ?>
                                    
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </header>

                <div class="topnav tapnav-primary-color">
                    <div class="container-fluid">
                        <nav class="navbar navbar-light navbar-expand-lg topnav-menu">
                            
                            <div class="collapse navbar-collapse" id="topnav-menu-content">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?= base_url() ?>">
                                            <i class="mdi mdi-home-analytics"></i>HOME
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="<?= base_url() ?>match-schedule">MATCH SCHEDULE</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?= base_url() ?>live-score">LIVE SCORE</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?= base_url() ?>teams">TEAMS</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?= base_url() ?>investment">INVESTMENT</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?= base_url() ?>tournaments">ALL TOURNAMENTS</a>
                                    </li>
                                    <!-- <li class="nav-item">
                                        <a class="nav-link" href="<?= base_url() ?>products">OUR PRODUCTS</a>
                                    </li> -->

                                    <li class="nav-item">
                                        <a class="nav-link" href="<?= base_url() ?>sponsor">SPONSOR</a>
                                    </li>

                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-charts" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            MORE <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-charts">
                                            <a href="<?= base_url() ?>agomps" class="dropdown-item">About AGOMPS</a>
                                            <a href="<?= base_url() ?>career" class="dropdown-item">Career</a>
                                            <a href="<?= base_url() ?>video" class="dropdown-item">Video</a>
                                            <a href="<?= base_url() ?>photo" class="dropdown-item">Photo</a>
                                            <a href="<?= base_url() ?>news-events" class="dropdown-item">News & Events</a>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>                

                <div class="page-content p-0">
                
                        <!-- start page title -->

                
                        