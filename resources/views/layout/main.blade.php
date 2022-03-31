<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from themes.potenzaglobalsolutions.com/html/mentor-bootstrap-4-admin-dashboard-template/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 19 Dec 2021 01:46:25 GMT -->
<head>
    <title>SPK PENERIMA BLT-DD</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="Admin template that can be used to build dashboards for CRM, CMS, etc." />
    <meta name="author" content="Potenza Global Solutions" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- app favicon -->
    <link rel="shortcut icon" href="{{asset("assets/img/favicon.ico")}}">
    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <!-- plugin stylesheets -->
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/vendors.css")}}" />
    <!-- app style -->
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/style.css")}}" />
</head>

<body>
<!-- begin app -->
<div class="app">
    <!-- begin app-wrap -->
    <div class="app-wrap">
        <!-- begin pre-loader -->
        <div class="loader">
            <div class="h-100 d-flex justify-content-center">
                <div class="align-self-center">
                    <img src="assets/img/loader/loader.svg" alt="loader">
                </div>
            </div>
        </div>
        <!-- end pre-loader -->
        <!-- begin app-header -->
        <header class="app-header top-bar">
            <!-- begin navbar -->
            <nav class="navbar navbar-expand-md">

                <!-- begin navbar-header -->
                <div class="navbar-header d-flex align-items-center">
                    <a href="javascript:void:(0)" class="mobile-toggle"><i class="ti ti-align-right"></i></a>
                    <a class="navbar-brand" href="index.html" >
                        <img src="{{asset("assets/img/logoblt.png")}}" alt="" style="width: 40%;">
                    </a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="ti ti-align-left"></i>
                </button>
                <!-- end navbar-header -->
                <!-- begin navigation -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="navigation d-flex">
                        <ul class="navbar-nav nav-left">
                            <li class="nav-item">
                                <a href="javascript:void(0)" class="nav-link sidebar-toggle">
                                    <i class="ti ti-align-right"></i>
                                </a>
                            </li>

                        </ul>
                        <ul class="navbar-nav nav-right ml-auto">

                            <li class="nav-item dropdown user-profile">
                                <a href="javascript:void(0)" class="nav-link dropdown-toggle " id="navbarDropdown4" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="assets/img/avtar/02.jpg" alt="avtar-img">
                                    <span class="bg-success user-status"></span>
                                </a>
                                <div class="dropdown-menu animated fadeIn" aria-labelledby="navbarDropdown">
                                    <div class="bg-gradient px-4 py-3">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="mr-1">
                                                <h4 class="text-white mb-0">Alice Williams</h4>
                                                <small class="text-white">Henry@example.com</small>
                                            </div>
                                            <a href="#" class="text-white font-20 tooltip-wrapper" data-toggle="tooltip" data-placement="top" title="" data-original-title="Logout"> <i
                                                    class="zmdi zmdi-power"></i></a>
                                        </div>
                                    </div>
                                    <div class="p-4">
                                        <a class="dropdown-item d-flex nav-link" href="javascript:void(0)">
                                            <i class="fa fa-user pr-2 text-success"></i> Profile</a>
                                        <a class="dropdown-item d-flex nav-link" href="javascript:void(0)">
                                            <i class="fa fa-envelope pr-2 text-primary"></i> Inbox
                                            <span class="badge badge-primary ml-auto">6</span>
                                        </a>
                                        <a class="dropdown-item d-flex nav-link" href="javascript:void(0)">
                                            <i class=" ti ti-settings pr-2 text-info"></i> Settings
                                        </a>
                                        <a class="dropdown-item d-flex nav-link" href="javascript:void(0)">
                                            <i class="fa fa-compass pr-2 text-warning"></i> Need help?</a>
                                        <div class="row mt-2">
                                            <div class="col">
                                                <a class="bg-light p-3 text-center d-block" href="#">
                                                    <i class="fe fe-mail font-20 text-primary"></i>
                                                    <span class="d-block font-13 mt-2">My messages</span>
                                                </a>
                                            </div>
                                            <div class="col">
                                                <a class="bg-light p-3 text-center d-block" href="#">
                                                    <i class="fe fe-plus font-20 text-primary"></i>
                                                    <span class="d-block font-13 mt-2">Compose new</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- end navigation -->
            </nav>
            <!-- end navbar -->
        </header>
        <!-- end app-header -->
        <!-- begin app-container -->
        @include("layout.leftbar")
        <!-- end app-container -->
        <!-- begin footer -->
        <footer class="footer">
            <div class="row">
                <div class="col-12 col-sm-6 text-center text-sm-left">
                    <p>&copy; Copyright 2019. All rights reserved.</p>
                </div>
                <div class="col  col-sm-6 ml-sm-auto text-center text-sm-right">
                    <p>Hand-crafted made with <i class="fa fa-heart text-danger mx-1"></i> by Potenza</p>
                </div>
            </div>
        </footer>
        <!-- end footer -->
    </div>
    <!-- end app-wrap -->
</div>
<!-- end app -->

<!-- plugins -->
<script src="{{asset("assets/js/vendors.js")}}"></script>

<!-- custom app -->
<script src="{{asset("assets/js/app.js")}}"></script>
</body>


<!-- Mirrored from themes.potenzaglobalsolutions.com/html/mentor-bootstrap-4-admin-dashboard-template/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 19 Dec 2021 01:47:32 GMT -->
</html>
